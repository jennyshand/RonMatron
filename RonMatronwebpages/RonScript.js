        <script>
            function chatFunction()
            {
                var value1 = document.getElementById("chat1");
                var value3 = document.getElementById("chat3");
                var value5 = document.getElementById("chat5");
                var chatText = document.getElementById("input-box");
                
//                value1.innerHTML = chatText.value
                
                var testval = value1.innerHTML;
                var textval = chatText.innerHTML;
                
                if (value1.innerHTML == 1)
                    {
                        value1.innerHTML = chatText.value;
//                        value3.innerHTML = document.getElementById("chat1").value;
//                        value5.innerHTML = testval.length;
                    }
                else if (value3.innerHTML == 3 && value1.innerHTML != 1)
                    {
                        value3.innerHTML = value1.innerHTML;
                        value1.innerHTML = chatText.value;
                    }
                else if (value5.innerHTML == 5 && value3.innerHTML != 3)
                    {
                        value5.innerHTML = value3.innerHTML;
                        value3.innerHTML = value1.innerHTML;
                        value1.innerHTML = chatText.value;
                    }
                else
                    {
                        value5.innerHTML = value3.innerHTML;
                        value3.innerHTML = value1.innerHTML;
                        value1.innerHTML = chatText.value;
                    }
                
            }
        </script>