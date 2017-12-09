<form method="post" action="test" enctype="multipart/form-data">
{{csrf_field()}}
<input type="file" name="image"/>
<input type="submit" value="save">
</form>