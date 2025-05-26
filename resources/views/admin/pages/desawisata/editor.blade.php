<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">
    <title>Classic editor with default styles</title>
    <script src="https://cdn.ckeditor.com/4.10.1/standard-all/ckeditor.js"></script>
</head>

<body>

	<textarea cols="80" id="editor1" name="editor1" rows="10" >Testing
	</textarea>

    <script>
        CKEDITOR.replace( 'editor1', {
            height: 260,
            width: 700
        } );
    </script>
</body>

</html>