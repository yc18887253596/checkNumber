<!doctype html>
<html>
    <head>
        <script src="{{asset('js/jquery-1.10.2.min.js')}}"></script>
        <mate charset="UTF-8">
            <style>
                body{
                    background: #afadad;
                }
                .box{
                    margin: auto;

                    width: 250px;
                    height: 300px;
                    background: #fefdfd;
                }
                input{
                    display: block;
                }
                .checkName{
                    margin-top: 20px;
                    border: 1px solid;
                    width: 200px;
                    height: 40px;

                }
            </style>
            </head>
    <body>
        <div class="wrap">
            <div class="box">
                用户名
                <input type="taxt" class="userName">
                </input>
                密码
                <input type="taxt" class="passWord">
                </input>
                验证码
                <input type="taxt" class="check" id="captcha_image">
                </input>
                <div class="checkName">
                    <img src="http://localhost:8000/captcha/" onclick="this.src='http://localhost:8000/captcha/?'+Math.random()">
                </div>
                <div class="checkResult">

                </div>
            </div>
        </div>
    </body>
    <script>
        $("#captcha_image").blur(function () {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $.ajax({
                type:"post",
                url : "/captcha-test",
                dataType:"json",
                data:{captcha:$("#captcha_image").val()},
                success:function(result){
                    if(result == 1){
                        $(".checkResult").html("<p style='color: green;'>验证码正确<p>");
                    }else {
                        $(".checkResult").html("<p style='color: red;'>验证码错误<p>");
                    }
                }
            })
        });
    </script>
</html>