<?php include_once "components/config.php"?>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="components/semantics/semantic.css" />
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<script src="components/jquery/jquery-3.2.1.js"></script>
<script src="components/semantics/semantic.js"></script>
<script src="components/semantics/package.js"></script>
<style>
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
    }

    @media screen and (max-width: 799px) {
        .container.fluid {
            padding: 15px 10px;
        }

        .computerOnly {
            display: none !important;
        }
    }

    @media screen and (min-width: 800px) {
        .container.fluid {
            padding: 0 10px;
        }

        .phoneOnly {
            display: none !important;
        }
    }

    body {
        background: black;
    }

    div.container.fluid {
        background: url('<?php echo $path['wasteBG']?>') repeat-x bottom;
        background-size: 100%;
        min-height: 100vh
    }

    .card .description {
        overflow-x: scroll;
    }

    ::-webkit-scrollbar{
        display: none;
    }

    .ui.inverted.menu a.item:hover{
        background-color: rgba(0, 0, 0, 0) !important;
    }
</style>