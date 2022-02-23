<script lang="ts">
  import { onMount } from "svelte";
  import * as yup from "yup";
  import { createForm, ErrorMessage } from "svelte-forms-lib";
  import { fade, fly } from "svelte/transition";

  let ready = false;
  let sendError = false;
  let sendSuccess = false;

  onMount(() => (ready = true));
  const {
    form,
    errors,
    state,
    isValid,
    isSubmitting,
    handleChange,
    handleReset,
    handleSubmit,
  } = createForm({
    initialValues: {
      name: "",
      surname: "",
      email: "",
      message: "",
    },
    validationSchema: yup.object().shape({
      name: yup.string().required(),
      email: yup.string().email().required(),
      message: yup.string().required(),
    }),
    onSubmit: (values) => {
      sendMail(values);
    },
  });

  async function getCaptcha() {
    await new Promise((resolve, reject) => {
      // grecaptcha.ready needs a callback so we create a promise to await
      grecaptcha.ready(resolve);
    });
    // grecaptcha.execute returns a promise so we can await it
    const token = await grecaptcha.execute(
      "6LeWU88ZAAAAAH1jvUzyCjwGhiR5J0f_RdAq3SeQ",
      { action: "contacto" }
    );
    return token;
  }

  const sendMail = async (values) => {
    const url = "/sendmail.php";

    const formData = new FormData();

    let token = await getCaptcha();

    formData.append("name", values.name);
    formData.append("surname", values.surname);
    formData.append("email", values.email);
    formData.append("phone", values.phone);
    formData.append("message", values.message);
    formData.append("token", token);
    formData.append("action", "contacto");

    // you have a few options for converting
    // the Promise.catch()
    // you can use a try {} catch {} block
    // or you can use .catch() on this sendMail function
    try {
      let response = await fetch(url, {
        method: "post",
        body: formData,
      });

      if (response.status == 202) {
        sendSuccess = true;
        document.querySelector("form").reset();
      }
      if (response.status == 400) {
        sendError = true;
      }
      if (response.status == 403) {
        sendError = true;
      }
      if (response.status == 406) {
        sendError = true;
      }
    } catch (err) {
      //alert(err);
      sendError = true;
    }
  };
</script>
<section class="w-full mx-auto bg-gray-300 dark:bg-gray-600 p-12" id="contact-form">
  <div class="flex flex-row flex-wrap items-start mx-auto max-w-screen-lg">
    {#if sendError}
    <div id="errormessage" class="p-4 bg-yellow-200 text-red rounded-xl">
      No se pudo enviar tu mensaje, puedes intentarlo nuevamente o comunicarte
      directamente a web@farid.ar
    </div>
    {/if} {#if sendSuccess}
    <div id="sendmessage" class="p-4 bg-green-200 rounded-xl">
      Tu mensaje ha sido enviado, te responderemos a la brevedad!
    </div>
    {/if}
    <form

      class="w-full lg:w-1/2 lg:px-8 order-2 lg:order-1"
      method="post"
      role="form"
      on:submit|preventDefault={handleSubmit}
    >
      <div class="flex flex-row flex-wrap text-left">
        <div class="w-full">
          <label class="w-full uppercase text-left text-xs" for="name"
            >nombre</label
          >
          <input
            class="w-full"
            type="text"
            id="name"
            name="name"
            required
            aria-required="true"
            on:change={handleChange}
            on:blur={handleChange}
            bind:value={$form.name}
          />
          {#if $errors.name}
          <p class="block w-full text-sm font-bold text-red">
            Por favor ingresa tu nombre y apellido
          </p>
          {/if}
          <input class="w-full" type="hidden" id="surname" name="surname" />
        </div>
        <div class="w-full">
          <label class="w-full uppercase text-left text-xs" for="email"
            >email</label
          >
          <input
            class="w-full"
            type="email"
            id="email"
            name="email"
            required
            aria-required="true"
            on:change={handleChange}
            on:blur={handleChange}
            bind:value={$form.email}
          />
          {#if $errors.email}
          <p class="block w-full text-sm font-bold text-red">
            Por favor ingresa tu email
          </p>
          {/if}
        </div>
        <div class="w-full">
          <label class="w-full uppercase text-left text-xs" for="message"
            >mensaje</label
          >
          <textarea
            class="w-full"
            rows="4"
            id="message"
            name="message"
            required
            aria-required="true"
            on:change={handleChange}
            on:blur={handleChange}
            bind:value={$form.message}
          ></textarea>
          {#if $errors.message}
          <p class="block w-full text-sm font-bold text-red">
            Por favor ingresa tu mensaje o consulta
          </p>
          {/if}
        </div>
        <div class="w-full">
          <button
            type="submit"
            disabled="{!isValid}"
            class="btn btn-box bg-brand text-gray-100"
          >
            Enviar
          </button>
        </div>
      </div>
    </form>
    <div class="w-full lg:w-1/2 text-left order-1 lg:order-2 mb-4">
      <h3 class="uppercase font-bold">Contacto</h3>
      <h4 class="mb-6">El punto de partida para cualquier proyecto</h4>
      <p class="text-sm mb-4">
        A partir de conocernos y conversar sobre los objetivos a lograr podremos
        establecer planes de trabajo para conseguirlos
      </p>
      <p
        class="text-light text-sm flex flex-row justify-start items-center text-brand"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="w-6 mr-2"
          viewBox="0 0 512 512"
        >
          <title>Mail</title>
          <rect
            x="48"
            y="96"
            width="416"
            height="320"
            rx="40"
            ry="40"
            fill="none"
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="32"
          />
          <path
            fill="none"
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="32"
            d="M112 160l144 112 144-112"
          />
        </svg>
        web@farid.ar
      </p>
    </div>
  </div>
</section>
