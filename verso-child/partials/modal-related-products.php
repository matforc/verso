<style>

	#related-products.wrapper-modal {
		position: fixed;
		z-index: 50;
		top: 0;
		right: 0;
		width: 100%;
		height: 100%;
		max-width: 100%;
		background: #FFF;
		overflow-y: scroll;
		-webkit-transform: translateX(100%);
		transform: translateX(100%);
		-webkit-transition: .2s All ease-in;
		transition: .2s All ease-in;
	}

    #related-products h2.text-center {
        font-size: 1.5em;
        line-height: 1.5;
        padding: 25px;
    }

	.relatedProduct.modal-overlay {
		position: fixed;
		z-index: 10;
		width: 100vw;
		height: 100vh;
		top: 0;
		left: 0;
		background: rgba(255, 255, 255, 0.55);
        -webkit-transition: .2s All ease-in;
        transition: .2s All ease-in;
        cursor: pointer;
        display: none;
	}

    .relatedProduct.modal-overlay.open {
        -webkit-transition: .2s All ease-in;
        transition: .2s All ease-in;
        display: block;
    }

	#related-products.wrapper-modal.open {
		-webkit-transform: translateX(0);
		transform: translateX(0);
		-webkit-transition: .2s All ease-in;
		transition: .2s All ease-in;
	}


	#related-products .inner-wrapper-modal {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		max-width: 100%;
		height: auto;
	}

	#related-products .wrapper {
		width: auto;
        padding-top: 40px;
	}

	#related-products i.fa-window-close {
        position: absolute;
        padding: 30px;
        cursor: pointer;
        width: 50px;
        height: 50px;
        margin: auto;
        text-align: center;
        background: transparent;
	}

	#related-products .gusto-item {
		text-align: center;
		margin: 20px 0;
		-webkit-transition: .3s all ease-out;
		transition: .3s all ease-out;
	}

    #related-products .gusto-item h3 {
        font-size: 1.5em;
        line-height: 1.4;
    }

	#related-products .gusto-item.isLoading {
		-webkit-transform: translateY(50px);
		transform: translateY(50px);
		opacity: 0;
	}

	#related-products .gusto-item a {
		display: block;
		padding: 30px;
		border: 1px solid #000;
		max-width: 350px;
		margin: auto;
		border-radius: 7px;
		-webkit-transition: .1s all ease-out;
		transition: .1s all ease-out;
	}

	#related-products .gusto-item a:hover {
		background: rgba(204, 204, 204, 0.3);
	}

	#related-products .gusto-item img {
		height: auto;
		width: auto;
		margin: auto;
	}

	#related-products .items-wrapper {
		margin-top: 30px;
	}

	#related-products .loading-bro {
		margin: 50px auto;
		width: 100%;
		text-align: center;
		position: absolute;
		top: 35vh;
		opacity: 1;
		-webkit-transition: .2s opacity ease-in;
		transition: .2s opacity ease-in;
	}
	#related-products .loading-bro > p {
		text-align: center;
		font-size: 1.6em;
		margin-bottom: 1em;
		font-weight: 300;
		color: #8E8E8E;
	}
	#related-products .loading-bro.loaded {
		opacity: 0;
	}

	#related-products #load {
		width: 100px;
		text-align: center;
		-webkit-animation: loading 3s linear infinite;
		animation: loading 3s linear infinite;
	}
	#related-products #load #loading-inner {
		stroke-dashoffset: 0;
		stroke-dasharray: 300;
		stroke-width: 10;
		stroke-miterlimit: 10;
		stroke-linecap: round;
		-webkit-animation: loading-circle 2s linear infinite;
		animation: loading-circle 2s linear infinite;
		stroke: #fbcd25;
		fill: transparent;
	}

	@-webkit-keyframes loading {
		0% {
			-webkit-transform: rotate(0);
			transform: rotate(0);
		}
		100% {
			-webkit-transform: rotate(360deg);
			transform: rotate(360deg);
		}
	}

	@keyframes loading {
		0% {
			-webkit-transform: rotate(0);
			transform: rotate(0);
		}
		100% {
			-webkit-transform: rotate(360deg);
			transform: rotate(360deg);
		}
	}
	@-webkit-keyframes loading-circle {
		0% {
			stroke-dashoffset: 0;
		}
		100% {
			stroke-dashoffset: -600;
		}
	}
	@keyframes loading-circle {
		0% {
			stroke-dashoffset: 0;
		}
		100% {
			stroke-dashoffset: -600;
		}
	}
	@media (min-width: 500px) {
		#related-products .inner-wrapper-modal {
			max-width: 400px;
		}

        #related-products.wrapper-modal {
			max-width: 400px;
		}
	}

    #back-to-top-related-product {
        bottom: 30px;
        right: 30px;
        z-index: 50;
        color: #FFF;
        background: #000;
        display: block;
        position: fixed;
        width: 40px;
        height: 40px;
        text-align: center;
        line-height: 40px;
        border-radius: 50%;
        opacity: 0;
        -webkit-transition: all .3s;
        transition: all .3s;
    }

    #back-to-top-related-product.visible {
        opacity: 1;
        -webkit-transition: all .3s;
        transition: all .3s;
    }


</style>

<div id="related-products" class="wrapper-modal">
	<div class="inner-wrapper-modal">
		<i class="fa fa-window-close fa-2x close-btn pull-right" aria-hidden="true">
		</i>

		<div class="wrapper">

			<h2 class="text-center">Gusti: <?php the_title() ?></h2>
			<div id="container" class="items-wrapper">

			</div>
		</div>
	</div>
</div>
<div class="relatedProduct modal-overlay"></div>
<a href="#" id="back-to-top-related-product" title="Back to top" class=""><i class="ion-chevron-up"></i> </a>
<!-- /.modal-overlay -->