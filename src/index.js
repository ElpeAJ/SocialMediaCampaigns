document
  .getElementById("searchForm")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form submission

    // Get search query
    var searchQuery = document.getElementById("searchInput").value;

    // Send search query to server using AJAX
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState == XMLHttpRequest.DONE) {
        if (xhr.status == 200) {
          // Display search results
          document.getElementById("searchResults").innerHTML = xhr.responseText;
        } else {
          // Handle error
          console.log("Error:", xhr.statusText);
        }
      }
    };
    xhr.open("POST", "search.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("searchQuery=" + encodeURIComponent(searchQuery));
  });
