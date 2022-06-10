<script>
  import { onMount } from 'svelte'
  let items = []
  onMount(async () => {
    items = [
      {
        title: 'Tempo Diverso',
        description: 'website autogestionable',
        customer: 'Di Lucca Comunicación',
        image: 'tempodiverso.jpg',
        class: ''
      },
      {
        title: 'Tecnolab',
        description: 'website autogestionable, catálogo de productos, e-commerce',
        customer: 'Franzoni Diseño',
        image: 'tecnolab.jpg',
        class: ''
      },
      {
        title: 'Osfrei',
        description: 'website + buscador de distribuidores',
        customer: 'Diseño: Hernán Gullo',
        image: 'osfrei2021.jpg',
        class: 'wide'
      },

      {
        title: 'Copelco Ltda.',
        description: 'portal de información, noticias y gestiones para asociados',
        customer: 'Diseño: Adrián Rementería',
        image: 'copelco.jpg',
        class: ''
      },
      {
        title: 'Carlos Fadigati - Fotógrafo',
        description: 'portfolio autogestionable',
        customer: '',
        image: 'fadigati2020.jpg',
        class: 'wide'
      },
      {
        title: 'Sistemas de Codificación',
        description: 'sitio + catálogo autogestionable',
        customer: 'Diseño: Adrián Rementería',
        image: 'siscod.jpg',
        class: ''
      },
      {
        title: 'Química Sigma',
        description: 'catálogo + galería autogestionable',
        customer: 'Diseño: Klou',
        image: 'sigma2.jpg',
        class: 'wide'
      },
      {
        title: 'Kani Kama',
        description: 'recetario autogestionable / PWA',
        customer: 'Diseño: Adrián Rementería',
        image: 'kkse.jpg',
        class: ''
      },
      {
        title: 'BuyGurú',
        description: 'sitio de ofertas autogestionable',
        customer: 'Diseño: Agustina Vazquez Durand',
        image: 'buyguru.jpg',
        class: ''
      },
      {
        title: 'Industrias Dica',
        description: 'catálogo autogestionable',
        customer: 'Diseño: Arazi & Asoc.',
        image: 'dica.jpg',
        class: ''
      },
      {
        title: 'Zenith Bicycles',
        description: 'catálogo autogestionable',
        customer: 'Diseño: Hernán Gullo',
        image: 'zenith2021.jpg',
        class: 'wide'
      },
      {
        title: 'Suyai',
        description: 'catálogo autogestionable',
        customer: 'Diseño: Klou',
        image: 'suyai.jpg',
        class: ''
      },
      {
        title: 'Cromoion',
        description: 'sitio + catálogo autogestionable',
        customer: 'Diseño: Franzoni Diseño',
        image: 'cromoion.jpg',
        class: ''
      },

      {
        title: 'Alpha Sourcing Expert',
        description: 'sitio autogestionable<br>con descargas de catálogos',
        customer: 'Diseño: Edgardo Díaz',
        image: 'ase-home.jpg',
        class: ''
      },
      {
        title: 'Busco Peón',
        description: 'Ofertas y pedidos de trabajo para el campo',
        customer: 'Arazi & Asociados',
        image: 'buscopeon.jpg',
        class: 'wide'
      },

      /* {
        title: 'Justo Aón',
        description: 'portfolio autogestionable',
        customer: 'Diseño: Silvina Campos',
        image: 'justoaon.jpg',
        class: ''
      }, */
      {
        title: 'Angela Copello',
        description: 'portfolio autogestionable',
        customer: 'Diseño: Victoria Martínez',
        image: 'angelacopello.jpg',
        class: 'wide'
      },
      {
        title: 'Arazi & Asociados',
        description: 'portfolio autogestionable',
        customer: 'Diseño: Arazi & Asociados',
        image: 'arazi.jpg',
        class: ''
      },
      {
        title: 'The Martínez',
        description: 'sitio + catálogo autogestionable',
        customer: 'Diseño: The Martínez',
        image: 'themartinez.jpg',
        class: ''
      },
      {
        title: 'Equipos para Fotolibros',
        description: 'catálogo autogestionable',
        customer: 'Diseño: Adrián Rementería',
        image: 'fotolibros.jpg',
        class: ''
      },
      {
        title: 'Virreinata',
        description: 'plataforma de cursos autogestionable',
        customer: 'Diseño: Franzoni Diseño',
        image: 'vxnata.jpg',
        class: 'wide'
      },
      {
        title: 'Interprint SAIC',
        description: 'portfolio autogestionable',
        customer: 'Diseño: Wakonda',
        image: 'interprint.jpg',
        class: ''
      }
    ]
  })
  import PortfolioItem from './PortfolioItem.svelte'
</script>

<section id="portfolio">
  <div class="top-bar">
    <h2
      class="py-12 text-brand text-2xl lg:text-5xl text-center tracking-wide bg-gray-900 bg-opacity-60"
    >
      algunos proyectos
    </h2>
  </div>
  <div class="portfolio">
    {#each items as item}
      <PortfolioItem {item} />
    {:else}
      <p>loading...</p>
    {/each}
  </div>
</section>

<style lang="postcss">
  @media (min-width: 768px) {
    .portfolio {
      display: grid;
      grid-gap: 0;
      grid-template-columns: repeat(auto-fit, minmax(24rem, 1fr));
      grid-auto-rows: 455px;
      grid-auto-flow: dense;
      background-color: #444;
    }
  }
  @media (min-width: 1200px) {
    .portfolio {
      grid-auto-rows: 460px;
    }
  }
  @media (min-width: 1600px) {
    .portfolio {
      grid-auto-rows: 480px;
    }
  }
</style>
