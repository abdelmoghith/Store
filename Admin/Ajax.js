// $(document).ready(function() {
//     // Function to load data initially
//     loadData();

//     // Function to load data periodically (every 5 seconds)
//     setInterval(function() {
//         loadData();
//     }, 5000);

//     // Function to load data via AJAX
//     function loadData() {
//         $.ajax({
//             url: 'Product.php', // Path to your PHP script to fetch data
//             type: 'GET',
//             success: function(response) {
//                 $('#data').html(response);
//             }
//         });
//     }
// });
