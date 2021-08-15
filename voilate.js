 $(document).ready(function() {
            
           $('body').on("cut copy paste", function(e) {
            e.preventDefault()
            alert('cut copy paste disbaled');
            });
            $('body').mousedown(function(e) {
                if (e.button == 2) {
                    e.preventDefault();
                    alert('right-click is disabled!');
                }
            });
        });