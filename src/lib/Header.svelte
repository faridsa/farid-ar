<script>
import Typed from 'typed.js';
import { onMount } from 'svelte';
onMount(() => {
    let typed = new Typed('#headline', {
        stringsElement: '#strings',
        typeSpeed: 15,
        backSpeed: 10,
        /*onComplete: (self) => {
            let portfolio = document.getElementById("portfolio");
            portfolio.scrollIntoView({behavior: "smooth"});
        },*/
    });
});
</script>
<header class="header text-right">
    <div class="logo">
        <a href="https://farid.ar">
            <img loading="lazy" src="/deco/logo-farid.svg" alt="farid web experience">
        </a>
    </div>
</header>
<section class="intro">
    <div  class="flex flex-col justify-center items-center p-12 h-full min-h-screen">
        <h1 class="headline text-5xl lg:text-7xl xl:text-9xl font-bold uppercase text-gray-100 ">
            <span class="words-wrapper" id="strings" style="display: none">
                <b>análisis.</b>
                <b>evaluación.</b>
                <b>planeamiento.</b>
                <b>desarrollo.</b>
                <b>lanzamiento.</b>
                <b>evolución.</b>
            </span>
            <span id="headline"></span>
        </h1>
        <h2 class="text-brand text-xl lg:text-3xl font-semibold">Tu negocio en internet es nuestro trabajo</h2>
    </div>
    <div class="mouse">
        <div class="scroll"></div>
    </div>
</section>

<style lang="postcss">
    html{
        scroll-behavior: smooth;
    }

    .intro{
        @apply w-full h-full relative min-h-screen;
    }

    .intro >div {
    /* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#444444+0,444444+100&0.1+0,1+75 */
    background: -moz-linear-gradient(left,  rgba(68,68,68,0.1) 0%, rgba(68,68,68,1) 70%, rgba(50,50,50,1) 100%); /* FF3.6-15 */
    background: -webkit-linear-gradient(left,  rgba(68,68,68,0.1) 0%,rgba(68,68,68,1) 70%,rgba(50,50,50,1) 100%); /* Chrome10-25,Safari5.1-6 */
    background: linear-gradient(to right,  rgba(68,68,68,0.1) 0%,rgba(68,68,68,1) 70%,rgba(50,50,50,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
    }

    .logo {
        z-index: 100;
        @apply absolute right-12 top-12 w-40;
    }
</style>
