<div class="tp-circle-dot">
    <div class="tp-border"></div>
    <div class="dots">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>

<style>
 .tp-circle-dot
 {
    width: 400px;
    height: 400px;
     position: relative;
}
.tp-border{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: 1px solid #fff;
    border-radius: 50%;   
}
.dots{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;    
}
.dots span{
     position: absolute;
    width: 8px;
    height: 8px;
    background: #fff;
    border-radius: 50%;
    display: block;   
}
.dots span:nth-child(1) {
    top: -4px;
    left: 50%;
    transform: translateX(-50%);
}
.dots span:nth-child(2) {
top: 50%;
    right: -4px;
    transform: translateY(-50%);    
}
.dots span:nth-child(3) {
    bottom: -4px;
    left: 50%;
    transform: translateX(-50%);    
}
.dots span:nth-child(4) {
     top: 50%;
    left: -4px;
    transform: translateY(-50%);   
}   
</style>