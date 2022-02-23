<script lang="ts">
    import Lazy from 'svelte-lazy';
    export let item

</script>



<div class="portfolio_item {item.class}">
    <Lazy height={400} fadeOption={0, 500} resetHeightDelay={500}>
        <img src="/portfolio/{item.image}" alt="{item.title}" class="w-full" >
    </Lazy>
   <div class="portfolio_item_hover">
       <div class="portfolio-border clearfix">
           <div class="item_info">
               <h4>{item.title}</h4>
               <p class="desc">{item.description}</p>
               <p class="customer">{item.customer}</p>
           </div>
       </div>
   </div>
</div>


<style lang="postcss">
.portfolio_item {
    position: relative;
    overflow: hidden;
    display: block;
}

.portfolio_item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: 50% 0;
    border-radius: 0;
}
.portfolio_item .portfolio_item_hover {
    position: absolute;
    top: 0px;
    left: 0px;
    height: 100%;
    width: 100%;
    background-color: rgba(0, 0, 0, .8);
    -webkit-transform: translate(-100%);
    transform: translate(-100%);
    opacity: 0;
    -webkit-transition: all .2s ease-in-out;
    transition: all .2s ease-in-out;
}

.portfolio_item .portfolio_item_hover .item_info {
    text-align: center;
    position: absolute;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    padding: 10px;
    width: 100%;
    font-weight: bold;
}

.portfolio_item .portfolio_item_hover .item_info h4 {
    display: block;
    color: #fff;
    font-size: 18px;
    -webkit-transform: translateX(-100px);
    transform: translateX(-100px);
    -webkit-transition: all .2s ease-in-out .2s;
    transition: all .2s ease-in-out .2s;
    opacity: 0;
}

.portfolio_item .portfolio_item_hover .item_info p{
   font-style: normal;
   display: inline-block;
   margin-top: 10px;
   -webkit-transform: translateX(-100px);
   transform: translateX(-100px);
   -webkit-transition: all .3s ease-in-out .3s;
   transition: all .3s ease-in-out .3s;
   opacity: 0;
   font-size: 10px;
   letter-spacing: 2px;
}

.portfolio_item .portfolio_item_hover .item_info .desc {
    background-color: rgb(230,107,13);
    padding: 5px 20px;
    border-radius: 25px;
    color: #333;
}

.portfolio_item .portfolio_item_hover .item_info .customer {
   color: #eee;
   display: block;
}

.portfolio_item:hover .portfolio_item_hover {
   opacity: 1;
   -webkit-transform: translateX(0);
   transform: translateX(0);
}

.portfolio_item:hover .item_info p,
.portfolio_item:hover .item_info h4 {
    opacity: 1;
    -webkit-transform: translateX(0);
    transform: translateX(0);
}

.wide {
    grid-column: span 2;
}
.tall {
    grid-row: span 2;
}
.big {
    grid-column: span 2;
    grid-row: span 2;
}

</style>
