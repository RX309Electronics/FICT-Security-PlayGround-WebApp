?php
session_start();

// Prevent easy login bypass by going to "Index.html" in the browser.
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Poster</title>
    <style>
        /* General Reset */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #111; /* Dark background for contrast */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }

        /* Poster Container */
        .poster {
            width: 600px;
            height: 850px; /* A-Series proportion */
            background-color: #e3ce16; /* Main Yellow */
            border: 15px solid #fff; /* White frame */
            display: grid;
            /* 4 Columns, 5 Rows */
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(5, 1fr);
            position: relative;
            box-shadow: 0 0 20px rgba(0,0,0,0.5);
        }

        /* --- Grid Items --- */

        /* 1. Top Left: Circle */
        .cell-circle {
            grid-column: 1 / 2;
            grid-row: 1 / 2;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .circle {
            width: 60%;
            height: 60%;
            background-color: #3a9e36; /* Green */
            border-radius: 50%;
        }

        .cell-solid-green {
            grid-column: 4 / 5;
            grid-row: 1 / 2;
            background-color: #3a9e36;
        }

        /* 3. Middle Black Grid Section */
        /* We create a container that spans all 4 columns and rows 2-4 */
        .black-grid-container {
            grid-column: 1 / 5;
            grid-row: 2 / 5;
            background-color: #050505;
            display: grid;
            /* Recreate the 4x3 grid with yellow lines */
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(3, 1fr);
            gap: 4px; /* These gaps act as the yellow lines */
            background-color: #e3ce16; /* Background color bleeds through gap */
            border-top: 4px solid #e3ce16; /* Top yellow line */
        }

        .black-cell {
            background-color: #050505;
        }

        
        .cell-letter-F {
            grid-column: 1 / 2;
            grid-row: 2;
            background-color: red;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #e3ce16;
            font-size: 8rem;
            font-weight: bold;
            padding-bottom: 10px; 
        }

        .cell-letter-O {
            grid-column: 2 / 3;
            grid-row: 2;
            background-color: green;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #e3ce16;
            font-size: 8rem;
            font-weight: bold;
            padding-bottom: 10px;
        }

        .cell-letter-N {
            grid-column: 3 / 4;
            grid-row: 2;
            background-color: blue;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #e3ce16;
            font-size: 8rem;
            font-weight: bold;
            padding-bottom: 10px;
        }

        .cell-letter-T {
            grid-column: 4 / 5;
            grid-row: 2;
            background-color: orange;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #e3ce16;
            font-size: 8rem;
            font-weight: bold;
            padding-bottom: 10px;
        }

        .cell-letter-Y {
            grid-column: 4;
            grid-row: 3;
            background-color: purple;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #e3ce16;
            font-size: 8rem;
            font-weight: bold;
            padding-bottom: 10px;
        }

        .cell-letter-S {
            grid-column: 4 / 5;
            grid-row: 4 / 5;
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #e3ce16;
            font-size: 8rem;
            font-weight: bold;
            padding-bottom: 10px;
        }

        /* 5. Bottom Footer Text */
        .footer {
            grid-column: 3 / 5; /* Spans columns 3 and 4 */
            grid-row: 5 / 6;
            background-color: #e3ce16;
            padding: 20px;
            display: flex;
            align-items: flex-end;
            justify-content: flex-start;
        }

        .footer p {
            font-size: 0.65rem;
            line-height: 1.4;
            color: #050505;
            font-weight: 600;
        }
        
    

    </style>
</head>
<body>

    <div class="poster">
        
        <!-- Top Row -->
        <div class="cell-circle">
            <div class="circle"></div>
        </div>
        <div class="cell-solid-green"></div>

        <!-- Middle Black Grid Area (Rows 2, 3, 4) -->
        <div class="black-grid-container">
            <div class="black-cell"></div>
            <div class="black-cell"></div>
            <div class="black-cell"></div>
            <div class="black-cell"></div>
            
            <div class="black-cell"></div>
            <div class="black-cell"></div>
            <div class="black-cell"></div>
            <div class="black-cell"></div>
            
            <div class="black-cell"></div>
            <div class="black-cell"></div>
            <div class="black-cell"></div>
            <div class="black-cell"></div>
        </div>

        <!-- Bottom Text Row (Row 4) -->
        <div class="cell-letter-F">F</div>
        <div class="cell-letter-O">O</div>
        <div class="cell-letter-N">N</div>
        <div class="cell-letter-T">T</div>
        <div class="cell-letter-Y">Y</div>
        <div class="cell-letter-S">S</div>


        <div class="footer">
            <p>Created by RIkxian van Houten For workshop interactive media Fontys ICT.</p>
        </div>

    </div>

</body>
</html>