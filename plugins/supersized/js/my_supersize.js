
function my_supersize(data)
{
	$("#supersized").empty(); //remove the background image if exist
	
	$.supersized({
		
		// Functionality
		//element_ul              :   element_bg,			// Element
		slideshow               :   1,			// Slideshow on/off
		autoplay				:	1,			// Slideshow starts playing automatically
		start_slide             :   1,			// Start slide (0 is random)
		stop_loop				:	0,			// Pauses slideshow on last slide
		random					: 	0,			// Randomize slide order (Ignores start slide)
		slide_interval          :   160000,		// Length between transitions
		transition              :   6, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
		transition_speed		:	1000,		// Speed of transition
		new_window				:	1,			// Image links open in new window/tab
		pause_hover             :   0,			// Pause slideshow on hover
		keyboard_nav            :   1,			// Keyboard navigation on/off
		performance				:	1,			// 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
		image_protect			:	1,			// Disables image dragging and right click with Javascript
												   
		// Size & Position						   
		min_width		        :   0,			// Min width allowed (in pixels)
		min_height		        :   0,			// Min height allowed (in pixels)
		vertical_center         :   1,			// Vertically center background
		horizontal_center       :   1,			// Horizontally center background
		fit_always				:	0,			// Image will never exceed browser width or height (Ignores min. dimensions)
		fit_portrait         	:   1,			// Portrait images will not exceed browser height
		fit_landscape			:   0,			// Landscape images will not exceed browser width
												   
		// Components							
		slide_links				:	'false',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
		thumb_links				:	0,			// Individual thumb links for each slide
		thumbnail_navigation    :   0,			// Thumbnail navigation
		slides 					:  	data,
									
		// Theme Options			   
		progress_bar			:	0,			// Timer for each slide							
		mouse_scrub				:	0
		
	});
	
}

function atualiza_slide(sld, direcao) {
	var url_virtual = $('#url_virtual').val();
	$('#lateral_esquerda').css({                      
		'width':$(document).width()/3+"px",
		'height':$(document).height()+"px"
	});
	$('#lateral_esquerda').hide();
	
	$('#lateral_direita').css({  
		'width':$(document).width()/3+"px",                    
		'height':$(document).height()+"px"
	});
	$('#lateral_direita').hide();
	
	$('#ambiente_slider_gc').val(sld);
	
	$('#capa_transparente').fadeIn('fast');
    $.ajax({
    	url: "ajax/novo_slide.php?tipo_produto="+sld,
        dataType: 'json',
        success: function( data ){
            
            //my_supersize(data.data);
            
            $('.info').empty();
			
            var supersized_top = 0;
            var supersized2_top = 0;
            var topo = 0;
            var time_menu_slider = 1500;
            
            switch (direcao){
            	case 'down':
            		supersized_top = -$(window).height();
            		supersized2_top = $(window).height();
            		topo = 0;
            	break;
            	
            	case 'up':
            		supersized_top = $(window).height();
            		supersized2_top = -$(window).height();
            		topo = 0;
            	break;
            	
            	default:
            		
            	break;
			}
			
			
			if(sld == 1 && direcao == 'up')
			{
				$('#menu_guapa').stop().animate({           
		            'bottom' : -71+'px',
		            'height' : '0px'
		        }, 1500,  function() {
	    			/*$(this).css({                      
			        	 'display':'none'
			       });*/
			       $(this).hide();
			       my_supersize(data.data);
			       menu_site_a_guapa(time_menu_slider,topo , supersized_top, supersized2_top, sld, direcao);
			       
				    setTimeout(function(){
					 	//$('#div_a_guapa').css({'display': 'none'});
					 	$('#div_a_guapa').hide();
					},2500);
				 }); 
		        
	             	
			}
			else
			{

				if(direcao != 'home')
				{ 
					$('#sombra_info_relative').show();
					$('#sombra_info_relative').css({  
						//'display': 'block',                    
						'right' : '0'
					 }).animate({       
					    'right' : '-239px'
					    //,'display': 'none' 
					 }, 1000, function(){
					 	$(this).hide();
					   	my_supersize(data.data);
						 menu_site_a_guapa(time_menu_slider,topo , supersized_top, supersized2_top, sld, direcao);
						 
						 
					 });
					
				}
				else
				{
				 	 my_supersize(data.data);
				   	 menu_site_a_guapa(time_menu_slider,topo , supersized_top, supersized2_top, sld, direcao);
					
				}
			  
				setTimeout(function(){
				 	//$('#div_a_guapa').css({'display': 'none'});
				 	$('#div_a_guapa').hide();
				},2500);
			}
			
			if(supersized_top != 0)
			{
				//menu_site_a_guapa(time_menu_slider,topo , supersized_top, supersized2_top, sld, direcao);
				
			}
			
			//$('#div_cases').css({'opacity': 1});
			
				if($('#capa_transparente').length > 0)
			{
				//$('#capa_transparente').fadeOut(800);
			}
			
			
			if(sld != 2)
			{
	            // array = new JSONArray(response);
	            /* var html_descricao = "";
	             for (var i=0; i < data.data_descricao.length; i++) {
	             	html_descricao += '<div class="info_e info_'+data.data_descricao[i].cont+'" style="display:none;">';
					html_descricao += '<img width=\"165\" height=\"'+data.data_descricao[i].height+'\" src=\"'+url_virtual+data.data_descricao[i].imagem+'\" title=\"\" alt=\"\">';
					html_descricao += '	<div class="info_titulo">PROJETO</div>';
					html_descricao += '	<div class="info_descricao">';
					html_descricao += '		<p>'+data.data_descricao[i].corpo+'</p>';
					html_descricao += '	</div>';
					html_descricao += '	<div class="veja_mais"><a href="#" onclick="fancy_function(\''+url_virtual+'componentes/popup_formularios.php?id_produto='+data.data_descricao[i].id+'acao=correspondentes&amp;subacao=\',900,587,\'iframe\','+data.data_descricao[i].cont+',\''+data.data_descricao[i].imagem_fundo+'\',\''+data.data_descricao[i].ext+'\')"><img src="'+url_virtual+'imagens/galeria/veja_mais.png" width="163"  height="26"/></a></div>';
					html_descricao += '	<div class="asignatura"></div>';
					html_descricao += '</div>';
	             };*/
	            var html_descricao = data.data_descricao;
	            
	             //$('.info').css({'display': 'block'});
	             $('.info').show();
	             $('.info').append(html_descricao);
	             if($(".info_0").length > 0)
				{
					if(direcao == 'home')
					{
						time_descricao = 5000;
					}
					else
					{
						time_descricao = 3500;
					}
				 	setTimeout(function(){
						$(".info_0").show();
					 	$(".info_0").css({ 
					 		//'display':'block',                     
							'top':'325px'
							 // 'display':'none'
						}).animate({           
						    top: '0px'
						}, 550, 'swing');
						//intervalo_slider();
						
						$('#control_div').hide();
						$('#control_div').css( "zIndex", 0 );
						$('#control_div').fadeIn("slow");
						/*$('#control_div').fadeIn("slow");
						$("#control_div").css({                   
							'top': -$(document).height()+'px',
							'left': $(document).width()/2+'px',
							'zIndex': 0
						}).animate({           
						    top: $(document).height()/2+'px'
						}, 1550, 'swing');*/
						
						
					},time_descricao);
						    
				}
	            
             }
             else
             {
             	$('#div_asignatura').hide();
             	//$('.info').css({'display': 'none'});
             	$('.info').hide();
             }
	            
        }
    });
}

function menu_site_a_guapa(time_menu_slider,topo , supersized_top, supersized2_top, sld, direcao)
{
	 $('#supersized li').css({                      
					 'top': supersized_top,
					 'visibility': 'visible',
					 'position': 'absolute'
	}).animate({           
	    top: topo
	}, time_menu_slider, function(){
		
		var time_sombra_descricao = 0;
		if(direcao == "home")
		{
			menu_site();
			$('#capa_transparente').fadeOut(3000);
			time_sombra_descricao = 2000;
		}
		else
		{
			$('#capa_transparente').fadeOut(1000);
		}
		
		$('.info').animate({
		    opacity: 1
		  }, "slow" );
		  
		
		if(sld == 1)
		{
			setTimeout(function(){
				sombra_descricao_cases();
				 $('#div_asignatura').show('slow');
			},time_sombra_descricao);	
			
			$('#control_div').show();
		}
		else if(sld == 2)
		{
			$('#menu_guapa').show();
			$('#menu_guapa').stop().css({                      
				//'display':'block',
				'bottom' : '-71px',
				'height' : '71px'
			}).animate({       
			    'bottom' : '0'
			}, 1000, 'swing');

			$('#control_div').hide();
		}
		
		
	});
	
	$('#supersized2 li').show();
	$('#supersized2 li').css({
		 'top': topo,                      
		 'visibility': 'visible',
		 'position': 'absolute'
		// ,'display':'block'
	}).animate({           
	    top: supersized2_top
	}, time_menu_slider, function(){
		//var display_zeta_izquerda = "block";
		if(sld == 2)
		{
			//display_zeta_izquerda = "none";
			$('#lateral_esquerda').hide();
		}
		else
		{
			$('#lateral_esquerda').show();
		}
		/*$('#lateral_esquerda').css({                      
			'display': display_zeta_izquerda
		});*/
		
		/*$('#lateral_direita').css({                      
			'display':'block'
		});*/

		$('#lateral_direita').show();

		//setTimeout(function(){
			$('#id_prevslide').css({'top': $(window).height()/2+'px'});
			$('#id_nextslide').css({'top': $(window).height()/2+'px'});
		//},3000);
	});
	
}

function sombra_descricao_cases()
{
	//Movimenta a sombra da Descricao dos CASES
	$('#sombra_info_relative').show();
     $('#sombra_info_relative').stop().css({  
     	//'display': 'block',                        
		'right' : '-239px'
	 }).animate({       
	    'right' : '0' 
	 }, 1000, function(){
	 	
		/*$('#lateral_esquerda').css({                      
			'display':'block'
		});*/
		$('#lateral_esquerda').show();
		/*$('#lateral_direita').css({                      
			'display':'block'
		});*/
		$('#lateral_direita').show();
		
	 });
	 
	 
}
 
 function menu_site()
 {
 	if($("#menu").length > 0)
	{
		var time_menu = 1500;
		
		$("#menu").stop().animate({
			top:"0px"
		}, {
			duration: time_menu,
			easing: "easeOutBounce"
		});
		
		setTimeout(function(){
			$('#m_a_guapa').css({ display: "block", opacity: 0 }).animate({ opacity: 1, left: "122px" }, {duration: 300, easing: "easeInExpo"});
			$('#m_cases').css({ display: "block", opacity: 0 }).animate({ opacity: 1, left: "212px" }, {duration: 400, easing: "easeInExpo"});
			$('#m_contato').css({ display: "block", opacity: 0 }).animate({ opacity: 1, left: "304px" }, {duration: 600, easing: "easeInElastic"});
			
		},time_menu);
	}
 }

 function fecha_menu_site()
 {
 	if($("#menu").length > 0)
	{
		var time_menu = 1500;
		
		setTimeout(function(){
			$('#m_a_guapa').css({ display: "block", opacity: 0 }).animate({ opacity: 1, left: "20px" }, {duration: 600, easing: "easeInElastic"});
			$('#m_cases').css({ display: "block", opacity: 0 }).animate({ opacity: 1, left: "20px" }, {duration: 400, easing: "easeInExpo"});
			$('#m_contato').css({ display: "block", opacity: 0 }).animate({ opacity: 1, left: "20px" }, {duration: 300, easing: "easeInExpo"});
			
		},0);
		
		setTimeout(function(){
			$("#menu").stop().animate({
				top:"-260px"
			}, {
				duration: time_menu,
				easing: "easeOutBounce"
			});
		},time_menu);
		
	}
 }
