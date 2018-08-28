<?php
//Cookie banner page
?>

<script>
    !function(e){var n=!1;if("function"==typeof define&&define.amd&&(define(e),n=!0),"object"==typeof exports&&(module.exports=e(),n=!0),!n){var o=window.Cookies,t=window.Cookies=e();t.noConflict=function(){return window.Cookies=o,t}}}(function(){function e(){for(var e=0,n={};e<arguments.length;e++){var o=arguments[e];for(var t in o)n[t]=o[t]}return n}function n(o){function t(n,r,i){var c;if("undefined"!=typeof document){if(arguments.length>1){if("number"==typeof(i=e({path:"/"},t.defaults,i)).expires){var a=new Date;a.setMilliseconds(a.getMilliseconds()+864e5*i.expires),i.expires=a}i.expires=i.expires?i.expires.toUTCString():"";try{c=JSON.stringify(r),/^[\{\[]/.test(c)&&(r=c)}catch(e){}r=o.write?o.write(r,n):encodeURIComponent(String(r)).replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g,decodeURIComponent),n=(n=(n=encodeURIComponent(String(n))).replace(/%(23|24|26|2B|5E|60|7C)/g,decodeURIComponent)).replace(/[\(\)]/g,escape);var f="";for(var s in i)i[s]&&(f+="; "+s,!0!==i[s]&&(f+="="+i[s]));return document.cookie=n+"="+r+f}n||(c={});for(var p=document.cookie?document.cookie.split("; "):[],d=/(%[0-9A-Z]{2})+/g,u=0;u<p.length;u++){var l=p[u].split("="),C=l.slice(1).join("=");'"'===C.charAt(0)&&(C=C.slice(1,-1));try{var g=l[0].replace(d,decodeURIComponent);if(C=o.read?o.read(C,g):o(C,g)||C.replace(d,decodeURIComponent),this.json)try{C=JSON.parse(C)}catch(e){}if(n===g){c=C;break}n||(c[g]=C)}catch(e){}}return c}}return t.set=t,t.get=function(e){return t.call(t,e)},t.getJSON=function(){return t.apply({json:!0},[].slice.call(arguments))},t.defaults={},t.remove=function(n,o){t(n,"",e(o,{expires:-1}))},t.withConverter=n,t}return n(function(){})});
</script>
<style>
	.cookie-wrapper {
		position: fixed;
		height: 90px;
        padding: 20px 0;
		background: rgba(11, 10, 14, 0.94);
		z-index: 90;
		width: 100%;
		bottom: 0px;
		left:0;
		transform: translateY(100%);
		transition: .2s All linear;
	}
	p.cookie-text {
		display: inline;
		float: left;
		color: #FFF;
		font-size: 9px;
		max-width: 76%;
		padding: 5px 1px;
        line-height: 1.4;
	}

	p.cookie-text a {
		text-decoration: underline;
		color: #FFF;
		font-size: inherit;
	}

	#cookie-banner .cookie-btn {
		display: inline;
		float: right;
		margin-top: 19px;
		font-size: 7px;
		width: 20%;
		max-width: 200px;
		text-transform: uppercase;
		padding: 8px;
		background: rgba(144, 142, 114, 0.55);
		border-radius: 0px;
		cursor: pointer;
		border-color: transparent transparent transparent !important;
	}

	.btn.active.focus, .btn.active:focus, .btn.focus, .btn:active.focus, .btn:active:focus, .btn:focus {
		outline: 0px auto -webkit-focus-ring-color;
		outline-color: -webkit-focus-ring-color;
		outline-style: auto;
		outline-width: 0px;
		outline-offset: 0px;
	}


	.cookie-wrapper.in{
		transform: translateY(0);
	}


	@media (min-width: 768px) {
		p.cookie-text {
			font-size: 14px;
		}
        button.cookie-btn {
            font-style: 12px;
        }
	}
    

</style>


<div id="cookie-banner" class="cookie-wrapper">
	<div class="container"><div class="row">
			<div class="col-sm-12">
				<!--googleoff: all -->
				<p class="cookie-text">Utilizziamo i cookie per assicurarti la migliore esperienza possibile sul nostro sito. <br> Navingando accetti i
					<a href="/privacy">termini e condizioni</a></p>

				<button class="btn btn-default cookie-btn">Accetta</button>
				<!--googleon: all -->
			</div>
			<!-- /.col-sm-12 -->
		</div>
		<!-- /.row -->


	</div>
	<!-- /.container -->

</div>
<!-- /.container-fluid -->


<script>
    jQuery(document).ready(function($){

        var cookieBanner = $('#cookie-banner');
        var cookie = Cookies.get('cookie-privacy');
        var cookieBtn = $('.cookie-btn');

        if (cookie == undefined) {
            $(cookieBanner).addClass('in');

            $(cookieBtn).on('click', function () {
                $(cookieBanner).removeClass('in');
                Cookies.set('cookie-privacy', 'vistoli-cookie-privacy');
            })
        }
    });
</script>