<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Using Laravel Framework</title>
<link rel="stylesheet" href="master.css">
<script type="text/JavaScript" src="entry.js" defer></script>

<body class="mine">
    <!-- comments (Joshua)
    @\yield is a blade directive to tell the program that anything inside this body tag is the content.
    @\yield('content') 
    using double brackets to echo the content variable is another way of doing what the yield does.
    it is also a blade component. 
    -->
    
    {{ $slot }}
</body>

<footer>
    <p class="footer">Joshua Anne P. Baldos</p>
    <p id="credit" class="footer">Photo credits : Joshua Anne P. Baldos | Mount Kosciuszko, Australia</p>
</footer>