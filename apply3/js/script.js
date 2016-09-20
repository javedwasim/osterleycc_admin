var default_content="";
	checkURL();

$(document).ready(function(){
  $('ul li a').click(function(){
		checkURL(this.hash);
		
		default_content = $('#content').html();
		setInterval("checkURL()",250);  
	});
});

var lasturl="";

function checkURL(hash)
{
	if(!hash) hash=window.location.hash;
	
	if(hash != lasturl)
	{
		lasturl=hash;
		
		// FIX - if we've used the history buttons to return to the homepage,
		// fill the pageContent with the default_content
		
		if(hash=="")
		$('#content').html(default_content);
		
		else
		loadPage(hash);
	}
}

function loadPage(url)
{
	
	url=url.replace('#step','');
	$.post("load_page.php", {page:url}, function(data)
        {
			$('#content').html(data);
			paging(url);

					

		});
		
}

