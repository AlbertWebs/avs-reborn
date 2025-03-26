
    $(document).ready(function(){
        alert('Albert');
        $("#flUpload").change(function () 
           {
            var iSize = ($("#flUpload")[0].files[0].size / 1024); 
            if (iSize / 1024 > 1) 
            { 
                if (((iSize / 1024) / 1024) > 1) 
                { 
                    iSize = (Math.round(((iSize / 1024) / 1024) * 100) / 100);
                    $("#lblSize").html( iSize + "Gb"); 
                }
                else
                { 
                    iSize = (Math.round((iSize / 1024) * 100) / 100)
                    $("#lblSize").html( iSize + "Mb"); 
                } 
            } 
            else 
            {
                iSize = (Math.round(iSize * 100) / 100)
                $("#lblSize").html( iSize  + "kb"); 
            }    
        }); 
});​
