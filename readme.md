# Desa Wisata Jawa Barat


Hirarki Select2 dengan bisa dipilih


```html
<script>
$('.select2').select2({
  templateResult: function (data) {    
    // We only really care if there is an element to pull classes from
    if (!data.element) {
      return data.text;
    }

    var $element = $(data.element);

    var $wrapper = $('<span></span>');
    $wrapper.addClass($element[0].className);

    $wrapper.text(data.text);

    return $wrapper;
  }
});
</script>
<style>   
.l2 {
  padding-left: 1em;
}
</style>
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.css" rel="stylesheet"/>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.js"></script>

<select class="select2" style="width: 200px">
  <option class="l1">Option 1</option>
  <option class="l2">Suboption 1</option>
  <option class="l2">Suboption 2</option>
  <option class="l2">Suboption 3</option>
  <option class="l1">Option 2</option>
</select>

```

#CDN Flowplayer

```txt

https://cdnjs.cloudflare.com/ajax/libs/flowplayer/7.2.7/flowplayer.js

https://cdnjs.cloudflare.com/ajax/libs/flowplayer/7.2.7/flowplayer.min.js

https://cdnjs.cloudflare.com/ajax/libs/flowplayer/7.2.7/flowplayer.swf

https://cdnjs.cloudflare.com/ajax/libs/flowplayer/7.2.7/flowplayerhls.swf

https://cdnjs.cloudflare.com/ajax/libs/flowplayer/7.2.7/skin/icons/flowplayer.eot

https://cdnjs.cloudflare.com/ajax/libs/flowplayer/7.2.7/skin/icons/flowplayer.svg

https://cdnjs.cloudflare.com/ajax/libs/flowplayer/7.2.7/skin/icons/flowplayer.ttf

https://cdnjs.cloudflare.com/ajax/libs/flowplayer/7.2.7/skin/icons/flowplayer.woff

https://cdnjs.cloudflare.com/ajax/libs/flowplayer/7.2.7/skin/icons/flowplayer.woff2

https://cdnjs.cloudflare.com/ajax/libs/flowplayer/7.2.7/skin/skin.css

https://cdnjs.cloudflare.com/ajax/libs/flowplayer/7.2.7/skin/skin.min.css

https://cdnjs.cloudflare.com/ajax/libs/flowplayer/7.2.7/skin/skin.min.css.map 
```
 
Disqus  Comment box
```html

<div id="disqus_thread"></div>
<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://desa-wisata-jabar.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                            

```

