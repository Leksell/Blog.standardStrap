   


   //Function Limit Title length for good SEO
                var titleMaxlen = 70;
                $(document).ready(function () {
                    $('#title').keyup(function () {
                        var len = this.value.length;
                        if (len >= titleMaxlen) {
                            this.value = this.value.substring();
                        }
                        checkLengthOnTitle();
                    });
                    checkLengthOnTitle();
                });
 
                //Checks the number of characters currently in the ingress-field in edit mode
                function checkLengthOnTitle() {
                    var len = $('#title').val().length;
                   
                    $('#view-post-btn .button').text ((titleMaxlen - len) + " characters left");
                }




 //Function to limit number of characters to 160 in article ingress
                var metaMaxlen = 160;
                $(document).ready(function () {
                    $('#custom_meta_desc_input').keyup(function () {
                        var len = this.value.length;
                        if (len >= metaMaxlen) {
                            this.value = this.value.substring(0, metaMaxlen);
                        }
                        checkLengthOnMeta();
                    });
                    checkLengthOnMeta();
                });
 
                //Checks the number of characters currently in the ingress-field in edit mode
                function checkLengthOnMeta() {
                    var len = $('#custom_meta_desc_input').val().length;
                   
                    $('.carleft').text ((metaMaxlen - len) + " characters left");
                }
