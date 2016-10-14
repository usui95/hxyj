
@extends('../layout')

@section('body')
<div id="wrapper">
    <div class="page-index" id="home">
        <div id="focus" class="focus">
  				<div class="hd">
  					<ul></ul>
  				</div>
  				<div class="bd">
  					<ul>
                <?php foreach($slides as $slide): ?>
                    <li><a href="<?php echo $slide->url; ?>"><img _src="<?php echo $slide->src; ?>" src="images/blank.png" /></a></li>
                <?php endforeach;  ?>
  					</ul>
  				</div>
  			</div>
        <div class="list">
            <div class="section">
                <div class="mcells_auto_fill">
                    <div data-index="0" class="body" style="width: 7.2rem; height: 9.42rem;">
                        <div><div class="items J_linksign-customize" style="width: 2.32rem; height: 1.53rem; left: 0rem; top: 0rem;"><a href="<?php echo $ninePatch[0]->url ?>"><img src="<?php echo $ninePatch[0]->thumb; ?>" /></a></div></div>
                        <div><div class="items J_linksign-customize" style="width: 2.32rem; height: 1.53rem; left: 2.44rem; top: 0rem;"><a href="<?php echo $ninePatch[1]->url ?>"><img src="<?php echo $ninePatch[1]->thumb; ?>" /></a></div></div>
                        <div><div class="items J_linksign-customize" style="width: 2.32rem; height: 1.53rem; left: 4.88rem; top: 0rem;"><a href="<?php echo $ninePatch[2]->url ?>"><img src="<?php echo $ninePatch[2]->thumb; ?>" /></a></div></div>
                        <div><div class="items J_linksign-customize" style="width: 2.32rem; height: 1.53rem; left: 0rem; top: 3.18rem;"><a href="<?php echo $ninePatch[3]->url ?>"><img src="<?php echo $ninePatch[3]->thumb; ?>" /></a></div></div>
                        <div><div class="items J_linksign-customize" style="width: 2.32rem; height: 1.53rem; left: 2.44rem; top: 3.18rem;"><a href="<?php echo $ninePatch[4]->url ?>"><img src="<?php echo $ninePatch[4]->thumb; ?>" /></a></div></div>
                        <div><div class="items J_linksign-customize" style="width: 2.32rem; height: 1.53rem; left: 4.88rem; top: 3.18rem;"><a href="<?php echo $ninePatch[5]->url ?>"><img src="<?php echo $ninePatch[5]->thumb; ?>" /></a></div></div>
                        <div><div class="items J_linksign-customize" style="width: 2.32rem; height: 1.53rem; left: 0rem; top: 6.36rem;"><a href="<?php echo $ninePatch[6]->url ?>"><img src="<?php echo $ninePatch[6]->thumb; ?>" /></a></div></div>
                        <div><div class="items J_linksign-customize" style="width: 2.32rem; height: 1.53rem; left: 2.44rem; top: 6.36rem;"><a href="<?php echo $ninePatch[7]->url ?>"><img src="<?php echo $ninePatch[7]->thumb; ?>" /></a></div></div>
                        <div><div class="items J_linksign-customize" style="width: 2.32rem; height: 1.53rem; left: 4.88rem; top: 6.36rem;"><a href="<?php echo $ninePatch[8]->url ?>"><img src="<?php echo $ninePatch[8]->thumb; ?>" /></a></div></div>
                    </div>
                </div>
              </div>

            <?php foreach ($shops as $shop): ?>
              <div class="section"><!--vue-if-->
                  <div class="J_linksign-customize">
                      <div class="item">
                          <div class="img">
                            <img class="ico lazy" src="<?php echo $shop->logo ?>" style="transform-origin: 0px 0px 0px; opacity: 1; transform: scale(1, 1);">
                            <?php if (!empty($shop->tag)): ?>
                              <img class="tag lazy" src="<?php echo $shop->tag; ?>">
                            <?php endif; ?>
                          </div>
                          <div class="info">
                              <div class="name"><p><?php echo $shop->name; ?></p></div>
                              <div class="brief"><p><?php echo $shop->address; ?></p></div>
                              <div class="price"><p><?php echo $shop->tel; ?></p></div>
                          </div>
                      </div><!--v-repeat-body.items-->
                    </div><!--vue-if-->
                  </div>
            <?php endforeach; ?>
        </div>
        @include('../footer')
      </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="/js/third/TouchSlide.1.1.js"></script>
<script type="text/javascript">
  TouchSlide({
    slideCell:"#focus",
    titCell:".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
    mainCell:".bd ul",
    effect:"left",
    autoPlay:true,//自动播放
    autoPage:true, //自动分页
    switchLoad:"_src" //切换加载，真实图片路径为"_src"
  });
</script>
@endsection
