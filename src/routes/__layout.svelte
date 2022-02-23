<script lang="ts">
  import '../global.postcss'
  import { theme } from './store'
  import { onMount } from 'svelte'
  import { fade, fly } from 'svelte/transition';
  let ready =false;
  onMount(() => ready = true);

</script>
{#if ready}
<main transition:fade>
  <slot />
</main>
{/if}
