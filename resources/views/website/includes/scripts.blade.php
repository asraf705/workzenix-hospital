<script>
    document.querySelectorAll('a.nav-link[href^="#"]').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault(); // stop default hash in URL
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
            // clean URL (remove #id if browser adds it)
            history.replaceState("", document.title, window.location.pathname + window.location.search);
        });
    });
</script>


<script src="{{ asset('website/vendors/@popperjs/popper.min.js') }}"></script>
<script src="{{ asset('website/vendors/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('website/vendors/is/is.min.js') }}"></script>
<script src="https://scripts.sirv.com/sirvjs/v3/sirv.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
<script src="{{ asset('website/vendors/fontawesome/all.min.js') }}"></script>
<script src="{{ asset('website/assets/js/theme.js') }}"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Fjalla+One&amp;family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100&amp;display=swap"
    rel="stylesheet">
