$(document).ready(function () {
  $('#srCode').on('keyup', function () {
      var srCode = $(this).val();

      // Perform an AJAX request to fetch data from the database
      $.ajax({
          url: './studentdata.php', // Create a PHP script to fetch data
          method: 'POST',
          data: { srCode: srCode },
          success: function (response) {
              var data = JSON.parse(response);
              if (data) {
                  // Populate the HTML elements with the retrieved data
                  $('[name="studentname"]').text(data.Name);
                  $('[name="studentdepartment"]').text(data.Department);
                  $('[name="studentprogram"]').text(data.CourseName);
              } else {
                  // Clear the HTML elements if no data is found
                  $('[name="studentname"]').text('No Student');
                  $('[name="studentdepartment"]').text('No Student');
                  $('[name="studentprogram"]').text('No Student');
              }
          }
      });
  });
});