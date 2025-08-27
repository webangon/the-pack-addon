<?php
//thepack_get_that_link($settings['flink']);
?>

<a href="#" class="tp-btn-1">
    <span class="pxl--btn-text" data-text="Discovery More">
        <span style="transition-delay: 0.045s;">D</span><span style="transition-delay: 0.09s;">i</span><span style="transition-delay: 0.135s;">s</span><span style="transition-delay: 0.18s;">c</span><span style="transition-delay: 0.225s;">o</span><span style="transition-delay: 0.27s;">v</span><span style="transition-delay: 0.315s;">e</span><span style="transition-delay: 0.36s;">r</span><span style="transition-delay: 0.405s;">y</span><span class="spacer" style="transition-delay: 0.45s;">&nbsp;</span><span style="transition-delay: 0.495s;">M</span><span style="transition-delay: 0.54s;">o</span><span style="transition-delay: 0.585s;">r</span><span style="transition-delay: 0.63s;">e</span>
    </span>
</a>

<style>
.tp-btn-1{
    position: relative;
    cursor: pointer;
    border: none;
    height: auto;
    display: inline-flex;
    align-items: center;
    text-align: center;
    background-color: black;
    justify-content: center;
    overflow: hidden;
    font-family: gtwalsheimpro;
    z-index: 1;   
    color:white;
    padding: 0 32px;
    line-height: 55px;
    border-radius: 8px;
}
.pxl--btn-text:before{
    content: attr(data-text);
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    padding: 0;
    -webkit-transition: -webkit-transform .2s, opacity .2s;
    transition: transform .2s, opacity .2s;
    transition-timing-function: ease, ease;
    -webkit-transition-timing-function: cubic-bezier(.75,0,.125,1);
    transition-timing-function: cubic-bezier(.75,0,.125,1);
    white-space: nowrap;
}
.pxl--btn-text>span{
    white-space: nowrap;
    display: inline-block;
    padding: 0;
    opacity: 0;
    -webkit-transform: translate3d(0, -14px, 0);
    transform: translate3d(0, -14px, 0);
    -webkit-transition: -webkit-transform .2s, opacity .2s;
    transition: transform .2s, opacity .2s;
    transition-timing-function: ease, ease;
    -webkit-transition-timing-function: cubic-bezier(.75,0,.125,1);
    transition-timing-function: cubic-bezier(.75,0,.125,1);
    line-height: normal;    
}
.tp-btn-1:hover {
    -webkit-transform: translateY(0);
    -khtml-transform: translateY(0);
    -moz-transform: translateY(0);
    -ms-transform: translateY(0);
    -o-transform: translateY(0);
    transform: translateY(0);
}
.tp-btn-1:hover .pxl--btn-text:before{
    opacity: 0;
    -webkit-transform: translate3d(0, 100%, 0);
    transform: translate3d(0, 100%, 0);    
}
.tp-btn-1:hover .pxl--btn-text span{
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);    
}
.tp-btn-1:not(:hover) .pxl--btn-text>span{
    transition-delay: 0s !important;    
}
</style>    