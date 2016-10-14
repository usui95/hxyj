@extends('../layout')

@section('css')
@parent
<style>
.gmu-media-detect{-webkit-transition: width 0.001ms; width: 0; position: relative; bottom: -999999px;}
@media screen and (width: 375px) { #gmu-media-detect0 { width: 100px; } }
</style>
@endsection

@section('body')
<div id="wrapper">
  <div class="header">
    <div class="left">
      <a class="home" href="<?php echo route('home'); ?>">
        <img src="//s1.mi.com/m/images/m/icon_back_n.png" class="ib">
      </a><!--vue-if--><!--vue-if-->
    </div>
    <div class="tit">
      <h2>
        <span class="title">商品分类</span>
      </h2><!--vue-if-->
    </div>
  </div>
  <div class="page-category">
    <div class="page-category-wrap">
        <?php foreach ($categories as $categoryName => $goodsList): ?>
            <?php if (!empty($goodsList)): ?>
                <div class="list-wrap">
                    <a name="<?php echo $categoryName; ?>"></a>
                    <h3 class="list_title"><?php echo $categoryName; ?></h3>
                    <ol class="list_category">
                        <?php foreach ($goodsList as $goods): ?>
                            <li class="J_linksign-customize">
                                <div class="img">
                                    <a href="<?php echo $goods->url; ?>"><img class="lazy" src="<?php echo $goods->logo; ?>" style="transform-origin: 0px 0px 0px; opacity: 1; transform: scale(1, 1);" /></a>
                                </div>
                                <div class="name">
                                    <span><?php echo $goods->name; ?></span>
                                </div>
                            </li>
                        <?php endforeach; ?>
                        </ol>
                    </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
  </div>
  @include('footer')
</div>
@endsection
