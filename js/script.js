// This file is intentionally left blank

window.onload = function() {
    editor = ace.edit("editor");
    editor.setTheme("ace/theme/monokai");
    editor.session.setMode("ace/mode/java");
}

function changeLanguage() {

    let language = $("#languages").val();

    if(language == 'c' || language == 'cpp')editor.session.setMode("ace/mode/c_cpp");
    else if(language == 'php')editor.session.setMode("ace/mode/php");
    else if(language == 'python')editor.session.setMode("ace/mode/python");
    else if(language == 'node')editor.session.setMode("ace/mode/javascript");
    else if(language == 'java')editor.session.setMode("ace/mode/java");
}

function executeCode() {

    //console.log(editor.getSession().getValue());

    $.ajax({
        url: "/app/compiler.php",
        method: "POST",
        data: {
            code: editor.getSession().getValue(),
            language: $("#languages").val()
        },
        success: function(response) {
            $(".output").html(response);
        }
    })
}