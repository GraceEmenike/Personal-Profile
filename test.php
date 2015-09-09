<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php

        function addRow() {
            echo "This is another row";
        }
        ?>
        <table border="1">
            <tr>
                <td>This displays something</td>
            </tr>
            <tr>
                <td><!--This doesn't--></td>
            </tr>
            <tr><td><?php addRow() ?></td></tr>
        </table>

    </body>
</html>
