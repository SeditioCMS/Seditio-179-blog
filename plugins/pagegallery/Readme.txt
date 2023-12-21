Add in page.tpl
=========================

<!-- BEGIN: PAGE_GALLERY -->
<div class="page-other">

	<div class="box-title">
		<h3>{PHP.L.Gallery}</h3>
	</div>
    	
	<div class="page-other-body">	
		
        	<div class="row row-flex">			
			
           		 <!-- BEGIN: PAGE_GALLERY_ROW -->
            			
				<div class="col-xs-12 col-sm-6 col-md-3 col-lg-4 gallery-item">					
					<figure class="gallery-container">
						<a class="gallery-img-link" href="{PAGE_GALLERY_ROW_URL}" data-fancybox="gallery">
							<img class="gallery-img img-responsive" src="{PAGE_GALLERY_ROW_THUMB|crop_image(%s, 300, 300)}" />
						</a>
					</figure>					
				</div>	
                		
			<!-- END: PAGE_GALLERY_ROW -->	
            		
		</div>
        	
	</div>
    	
</div>
<!-- END: PAGE_GALLERY -->
