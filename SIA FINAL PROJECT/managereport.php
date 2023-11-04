<?php include "./components/sidebar.php" ?>
<!DOCTYPE html>
<html>
    <head>

    <link rel="stylesheet" href="css/managereport.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <title>Report Manager</title>
    </head>
<body>
    <section class="container">
                <h1 class="">Report Manager</h1>
                <button class="tab-button" id="vio-list">Violation List</button>
                <button class="tab-button" id="call-slip-req">Call Slip Required List</button>
                    <div class="dropdown">
                    <select id="sortDropdown">
                        <option value="" disabled selected>Sort</option>
                        <option value="option1">Option 1</option>
                        <option value="option2">Option 2</option>
                        <option value="option3">Option 3</option>
                    </select>
                    </div>
            </div>
            <div class="mngreport-body">
                <table>
                    <tr class="mngreport-topic-heading">
                        <th>   </th>
                        <th>Name</th>
                        <th>Violation</th>
                        <th>Date</th>
                        <th>   </th>
                        <th>   </th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Sofia Mae Pepito</td>
                        <td>Multiple piercings</td>
                        <td>10/10/10</td>
                        <td class="centered-cell">
                            <button class="btncss" onclick="SubmitEvent">
                                View More
                            </button>
                        </td>
                        <td class="centered-cell">
                        <button class="btncss" onclick="SubmitEvent">
                                <span class="fas fa-trash"></span>
                                Delete
                            </button>
                        </td>
                    </tr>
                </table>
            </div>

    </section>
</body>
</html>