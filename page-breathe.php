<?php
/*
 * Template Name: Breathe Template
 * Description: A Page Template with a Page Builder design.
 */

$companyLogo = get_option('4gacademy_op-company_logo');
$companyFavicon = get_option('4gacademy_op-company_favicon');
 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <!-- Styles -->
    <!-- Favicons-->
    <link rel="shortcut icon" href="<?php if(isset($companyFavicon)) {?><?php echo esc_url($companyFavicon); ?><?php }?>" type="image/x-icon"/>
      <?php wp_head();?>

    <!-- Fonts -->
    <!-- Favicons -->
    
    </head>

  <body <?php body_class(); ?>>

<main class="container" style="z-index: 1000000;">
      <div class="row">

        <!-- Main content -->
        <div class="col-md-12 main-content" role="main">
          
          <?php if (have_posts()){ ?>
    <?php while (have_posts()) : the_post()?>
      <?php the_content(); ?>
    <?php endwhile; ?>
  
  <?php }else {
    echo 'Page Canvas For Page Builder'; 
  }?>

          
        </div>
      </div>
</main>
<canvas id='canv' style="position: absolute;top: 0px; left: auto; right: auto; z-index:-1;"></canvas>

<script type="text/javascript">
var obj = {
  rad: {
    base: 120,
    vary: 30,
    step: Math.PI / 180,

  },
  c: {
    w: window.innerWidth,
    h: window.innerHeight
  },
  lay: {
    num: 10,
    dist: 28,
    diff: Math.PI / 90
  }
};

function Circle(x, y, step) {
  this.x = x;
  this.y = y;
  this.step = step

}

Circle.prototype.draw = function($) {
  var grd = $.createLinearGradient(this.x + this.x * 2, this.y + this.y * 2, this.x + this.x * 2, 1);
  grd.addColorStop(0, "hsla(232, 95%, 70%, 1)");
  grd.addColorStop(0.5, "hsla(267, 25%, 45%, 1)");
  grd.addColorStop(1, "hsla(233, 80%, 50%, 1)");
  this.step += obj.rad.step;
  this.col = grd;

  $.beginPath();
  var r = obj.rad.base + Math.sin(this.step) * obj.rad.vary;
  $.arc(this.x, this.y, r, 0, 2 * Math.PI, true);
  $.strokeStyle = this.col;
  $.stroke();
}

function init() {
  var d = obj.lay.dist,
    t = Math.PI / 3,
    x = obj.c.w / 2,
    y = obj.c.h / 2,

    clay = [
      [new Circle(x, y, 0)]
    ],
    circ, lay, s, pt, ptx, pty, dx, dy;

  for (lay = 1; lay < obj.lay.num; lay++) {
    circ = [];

    for (s = 0; s < 6; s++) {

      ptx = x + d * lay * Math.cos(t * s);
      pty = y + d * lay * Math.sin(t * s);
      dx = d * Math.cos(t * s + t * 2);
      dy = d * Math.sin(t * s + t * 2);
      for (pt = 0; pt < lay; pt++) {

        circ.push(new Circle(ptx + dx * pt, pty + dy * pt, -1 * lay * obj.lay.diff));
      }
    }
    clay.push(circ);
  }
  return clay;
}

var c = document.getElementById('canv');
c.width = obj.c.w;
c.height = obj.c.h;
document.body.appendChild(c);
var ctx = c.getContext('2d');
ctx.fillRect(0, 0, c.width, c.height);
ctx.globalCompositeOperation = 'lighter';

window.addEventListener('resize', function() {
  c.width = w = window.innerWidth;
  c.height = h = window.innerHeight;
}, false);

var clay = init();

function run() {
  var i, j, ilen, jlen;
  ctx.clearRect(0, 0, obj.c.w, obj.c.h);

  for (i = 0, ilen = clay.length; i < ilen; i++) {

    for (j = 0, jlen = clay[i].length; j < jlen; j++) {
      clay[i][j].draw(ctx);

    }
  }

}
window.requestAnimFrame = (function() {
  return window.requestAnimationFrame ||
    window.webkitRequestAnimationFrame ||
    window.mozRequestAnimationFrame ||
    window.oRequestAnimationFrame ||
    window.msRequestAnimationFrame ||
    function(callback) {
      window.setTimeout(callback, 1000 / 60);
    };
})();

function go() {
  run();
  window.requestAnimFrame(go);
}
go();
</script>
      <?php wp_footer();?>
  </body>
</html>