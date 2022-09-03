$(document).ready(function(){
    $("#Printthetable").click( function (){
        printElement(document.getElementById("printme"));
        });
});
function printElement(elem) {
var domClone = elem.cloneNode(true);

var $printSection = document.getElementById("printSection");

if (!$printSection) {
var $printSection = document.createElement("div");
$printSection.id = "printSection";
document.body.appendChild($printSection);
}

// $printSection.innerHTML = "";
$printSection.appendChild(domClone);
window.print();
location.reload();
// alert('printing page');

}
function print5(){
pdf();

$('#reportModal').modal('hide');


}
function pdf(){
    var HTML_Width = $(".html-content").width();
            var HTML_Height = $(".html-content").height();
            var top_left_margin = 15;
            var PDF_Width = HTML_Width + (top_left_margin * 4);
            var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
            var canvas_image_width = HTML_Width;
            var canvas_image_height = HTML_Height;

            var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

            html2canvas($(".html-content")[0]).then(function (canvas) {
                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                var pdf = new jsPDF('p','pt', [PDF_Width, PDF_Height]);
                pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
                for (var i = 1; i <= totalPDFPages; i++) {
                    pdf.addPage(PDF_Width, PDF_Height);
                    pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                }
                pdf.save("MASTERPATIENTLIST.pdf");
                //window.location = "/home"
                $(".html-content").hide();
                location.reload();
            });
}
