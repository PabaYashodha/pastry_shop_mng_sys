<?php
require_once "header.php";
?>
 
 <input id="tags">
<script type="text/javascript">
  var availableTags = ['Football','Cricket','Basketball','Baseball'];
  $( "#tags" ).autocomplete({
    source: availableTags
  });
</script>

<?php require_once "scriptInclude.php" ?>
<?php require_once "footer.php" ?>