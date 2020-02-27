---
title: Outputting Markup
---

# Outputting Markup

To output the SEO markup replace your existing SEO markup (title, SEO meta tags) 
with `{% seo %}` in the `head` tag in your layout file.

```twig
<head>
	<meta charset="utf-8"/>
	
	{% seo %}
	
	<link rel="stylesheet" href="css/style.css">
</head>
```

## Overriding SEO

To specify the handle of the SEO field to use, pass it as the first argument 
(defaults to `seo`).

```twig
{% seo 'mySeoField' %}
```

To override certain values in the SEO data, pass an object with the values you 
want to change.

```twig
{% seo {
	title: 'My new title',
} %}
```

You can override the markup by passing the replacement markup between the 
`{% seo %}` tags. You will have access to the `seo` twig variable, containing 
the data from the SEO field.

```twig
{% seo %}
	{% if not seo.title %}
		<title>{{ siteName }}</title>
	{% endif %}

	<meta name="description" content="{{ seo.description }}" />
{% endseo %}
```

You can mix and match any of the above into a single `{% seo %}` tag.

```twig
{% seo 'mySeoField' {
	title: 'My Title',
} %}
	<link rel="home" href="{{ siteUrl }}/en/">
{% endseo %}
```

You can override any of the above on a per-template instance.

```twig
{% extends '_layout.twig' %}

{% seo {
	title: 'Contact Us',
} %}
```
