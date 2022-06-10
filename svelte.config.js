import preprocess from 'svelte-preprocess'
import ssr from '@sveltejs/adapter-static'

/** @type {import('@sveltejs/kit').Config} */
export default {
  preprocess: [
    preprocess({
      defaults: {
        style: 'postcss'
      },
      postcss: true
    })
  ],


  kit: {
    prerender: {
      default: true
    },
    adapter: ssr(),
    /* 
    See https://github.com/sveltejs/svelte-preprocess/issues/362
    config.kit.target is no longer required, and should be removed    
    target: '#svelte'
    */  
  }
}
