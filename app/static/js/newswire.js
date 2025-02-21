 function myMenuFunction() {
    var i = document.getElementById("navMenu");

    if(i.className === "nav-menu") {
        i.className += " responsive";
    } else {
        i.className = "nav-menu";
    }
   }


   var a = document.getElementById("loginBtn");
    var b = document.getElementById("registerBtn");
    var x = document.getElementById("login");
    var y = document.getElementById("register");

    function login() {
        x.style.left = "4px";
        y.style.right = "-520px";
        a.className += " white-btn";
        b.className = "btn";
        x.style.opacity = 1;
        y.style.opacity = 0;
    }

    function register() {
        x.style.left = "-510px";
        y.style.right = "5px";
        a.className = "btn";
        b.className += " white-btn";
        x.style.opacity = 0;
        y.style.opacity = 1;
    }
   
    
    function react(newsId, reactionType) {
        fetch('app/user/reaction.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ news_id: newsId, reaction_type: reactionType })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload(); 
            } else {
            }
        })
        .catch(error => console.log());
    }
    
    
        function validateNewsletter() {
            let email = document.querySelector("input[type='email']").value;
            if (!email.includes("@") || !email.includes(".")) {
                alert("Please enter a valid email address.");
                return false;
            }
            alert("Thank you for subscribing!");
            return true;
        }
        function toggleNews(newsId) {
            var newsContent = document.getElementById("news-" + newsId);
            var button = event.target;

            if (newsContent.style.display === "none" || newsContent.style.display === "") {
                newsContent.style.display = "block";
                button.textContent = "See Less";
            } else {
                newsContent.style.display = "none";
                button.textContent = "See More";
            }
        } 
    
    