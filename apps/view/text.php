<?php
require_once "header.php";
?>
<script>
  $( function() {
    var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
    $( "#tags" ).autocomplete({
      source: availableTags
    });
  } );
  </script>
</head>
<body>
 
<div class="ui-widget">
  <label for="tags">Tags: </label>
  <input id="tags">
</div>
<div class="ui-widget" >
  <label for="tags">Tags: </label>
  <input id="stockSupplierNames">
</div>
<?php require_once "scriptInclude.php" ?>
<script>
    $(window).load(getSupplierData(), getRowItemData());
</script>
<?php require_once "footer.php" ?>