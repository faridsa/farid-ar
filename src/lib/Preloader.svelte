<script>

  import { onMount } from 'svelte';

  onMount(() => {
    document.onload = function() {
      document.getElementById('#preloader').style.display = 'none';
    }
  })
</script>

<style lang="postcss">

  #preloader {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #444;
    z-index: 1000;
    transition: all .5s ease-in-out;

  }

  .pre-container {
    position: absolute;
    left: 50%;
    top: 50%;
    bottom: auto;
    right: auto;
    -webkit-transform: translateX(-50%) translateY(-50%);
    transform: translateX(-50%) translateY(-50%);
    text-align: center;
  }
  .spinner {
        width: 40px;
        height: 40px;
        position: relative;
        margin: 100px auto;
    }
  .double-bounce1,
  .double-bounce2 {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background-color: rgb(230,107,13);
    opacity: 0.6;
    position: absolute;
    top: 0;
    left: 0;
    -webkit-animation: bounce 2.0s infinite ease-in-out;
    animation: bounce 2.0s infinite ease-in-out;
  }

  .double-bounce2 {
    -webkit-animation-delay: -1.0s;
    animation-delay: -1.0s;
  }


  @-webkit-keyframes bounce {
    0%,
    100% {
      -webkit-transform: scale(0.0)
    }
    50% {
      -webkit-transform: scale(1.0)
    }
  }

  @keyframes bounce {
    0%,
    100% {
      transform: scale(0.0);
      -webkit-transform: scale(0.0);
    }
    50% {
      transform: scale(1.0);
      -webkit-transform: scale(1.0);
    }
  }
</style>

<div id="preloader">
  <div class="pre-container">
    <div class="spinner">
      <div class="double-bounce1"></div>
      <div class="double-bounce2"></div>
    </div>
  </div>
</div>
