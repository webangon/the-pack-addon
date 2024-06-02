<div class="filter-sidebar">
<?php if (is_array($settings['items'])) {
    $widgets = array_filter($settings['items']);
    foreach ($widgets as $key => $value) {
        include_once plugin_dir_path(__FILE__) . $value['type'] . '.php';       
    }
}?>
</div>
<style>
    select {
    max-width: 130px;
    text-overflow: ellipsis;
    font-size: 0.8125rem;
    font-weight: 600;
    padding-left: 0;
    height: auto;
    background-color: transparent;
    border: 0;
    -webkit-box-shadow: none;
    box-shadow: none;  
}

.filter-sidebar .price_slider{ 
    margin-bottom: 1em; 
}
.filter-sidebar .price_slider_amount {
    text-align: right;
    line-height: 2.4em;
    font-size: 0.8751em;
}
.filter-sidebar .price_slider_amount .button {
    font-size:1.15em;
}
.filter-sidebar .price_slider_amount .button {
    float: left;
}
.filter-sidebar .ui-slider {
    position: relative;
    text-align: left;
}
.filter-sidebar .ui-slider .ui-slider-handle {
    position: absolute;
    z-index: 2;
    width: 0.9em;
    height: 0.9em;
    cursor: pointer;
    outline: none;
    top: -.3em;
}
.filter-sidebar .ui-slider .ui-slider-handle:last-child {
    margin-left: -1em;
}
.filter-sidebar .ui-slider .ui-slider-range {
    position: absolute;
    z-index: 1;
    font-size:.7em;
    display: block;
    border: 0;
    -webkit-border-radius: 1em;
    -moz-border-radius: 1em;
    border-radius: 1em;
}
.filter-sidebar .ui-slider-horizontal {
    height:.5em;
}
.filter-sidebar .ui-slider-horizontal .ui-slider-range {
    top: 0;
    height: 100%;
}
.filter-sidebar .ui-slider-horizontal .ui-slider-range-min {
    left: -1px;
}
.filter-sidebar .ui-slider-horizontal .ui-slider-range-max {
    right: -1px;
}	
.filter-sidebar .filter-item li a{
    display: inline-flex;
    gap: 5px;
}
.filter-sidebar .search-form{
    display: flex;
}
.filter-sidebar .filter-item li label{
    cursor: pointer;
}
</style>