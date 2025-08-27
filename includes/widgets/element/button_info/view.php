<?php
//thepack_get_that_link($settings['flink']);
?>

<a href="#" class="tp-btn-2">
    <span class="tp-icon duplicated">K</span>
    <span class="tp-text">Read More</span>
    <span class="tp-icon main">K</span>
</a>

<style>
.tp-btn-2{
    position: relative;
    display: flex;
    width: fit-content;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 16px;
    border: none;
    outline: none;
    font-style: normal;
    font-weight: 400;
    color: #fff;
    padding: 0;
    margin: 0;
    white-space: nowrap;
    -webkit-transition: .25s linear;
    -khtml-transition: .25s linear;
    -moz-transition: .25s linear;
    -ms-transition: .25s linear;
    -o-transition: .25s linear;
    transition: .25s linear;
    height:60px;
    padding-inline: 0 60px;
}
.duplicated{
     position: absolute; 
        scale: 0;
    left: 0;
        width:60px;
    height:60px;
    border-radius: 50%;
}
.main{
    position: absolute;
    right: 0;
    top: 0;
    width:60px;
    height:60px;
    border-radius: 50%;
}
.tp-icon{
background-color: #C9F31D; 
            align-items: center;
    justify-content: center;
    display:flex;
        transition: inherit;
}
.tp-text{
position: relative;
    border-radius: 100px;
    height: 100%;
    padding-inline: 50px;  
        background-color: #C9F31D;
        align-items: center;
    justify-content: center;
    display:flex;
}
.tp-btn-2:hover{
    padding-inline: 60px 0px;
}
.tp-btn-2:hover .duplicated{
  scale: 1;  
}
.tp-btn-2:hover .main{
    scale: 0; 
}
</style>    