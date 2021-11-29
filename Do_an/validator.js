// Đối tượng Validator
function Validator(options){

    var selecterRules ={};
    // Hàm thực hiện xử lý onbur
    function xuly_onbur(inputElement,rule){
        var errorElement = inputElement.parentElement.querySelector(options.errorSelector); // Lấy ra thẻ span trong thẻ cha
        var errorMessage ;
        // var errorMessage = rule.test(inputElement.value);

        // Lấy ra từng rules của selecter
        var rules = selecterRules[rule.selector];
        

        // Lặp qua từng rule và kiểm tra
        // Nếu có lỗi thì dừng việc kiểm tra
        for(var i = 0; i < rules.length; i++) {
            errorMessage = rules[i](inputElement.value);
            if (errorMessage) break;
        }
            // Nếu có lỗi
            if(errorMessage){
                errorElement.innerText = errorMessage;
                inputElement.parentElement.classList.add('invalid');
            }else{
                errorElement.innerText ="";
                inputElement.parentElement.classList.remove('invalid');
            }
            return !errorMessage;
    }

    // Lấy element của form cần validate
    var formElement = document.querySelector(options.form);
    if(formElement){
        formElement.onsubmit = function(e){
            // e.preventDefault();
            var isFormValid = true;

            options.rules.forEach(function(rule){

                // Lặp qua từng rules và xử lý onbur
                var inputElement = formElement.querySelector(rule.selector);
                var isValid = xuly_onbur(inputElement,rule);

                if(!isValid){
                   isFormValid = false;
                }
            });

            if(isFormValid){
                console.log('Không lỗi')
            }else{
                console.log('Có lỗi')
            }
        }


        // Lặp qua mỗi rule và xử lý (lắng nghe sự kiện blur, input,...)
        options.rules.forEach(function(rule){

            // Lưu lại các rules cho mỗi input
            if(Array.isArray(selecterRules[rule.selector])){ 
                selecterRules[rule.selector].push(rule.test)
            }else{
                selecterRules[rule.selector] = [rule.test]; //Chạy lần đầu nó sẽ lọt vào đây
            }
            // selecterRules[rule.selector] = rule.test;
            var inputElement = formElement.querySelector(rule.selector);
            if(inputElement){
                // xử lý trường hợp blur khỏi input
                inputElement.onblur = function() {
                    xuly_onbur(inputElement,rule);
                }

                // xử lý ,mỗi khi người dùng nhập vào input
                inputElement.oninput = function(){
                    var errorElement = inputElement.parentElement.querySelector(options.errorSelector);
                    errorElement.innerText ="";
                    inputElement.parentElement.classList.remove('invalid');
                }
            }
        });


    }
}

// Định nghĩa rules
// Nguyên tắc rules:
// 1.Có lỗi -> message lỗi
// 2.hợp lệ -> không trả ra gì cả(undefined)
Validator.isRequied = function(selector,message){
    return {
        selector: selector,
        test : function(value){
            return value.trim() ? undefined :message || 'Vui lòng nhập trường này!';
        }
    };
}
Validator.isEmail = function(selector,message){
    return {
        selector: selector,
        test : function(value){
            var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            return regex.test(value) ? undefined : message ||'Vui lòng nhập Email của bạn'
        }
    };
}
Validator.minLenght = function(selector, min,message){
    return {
        selector: selector,
        test : function(value){
            return value.length >= min ? undefined :message || `Vui lòng nhập tối thiểu ${min} kí tự`;
        }
    };
}
Validator.isConfirmed = function(selector, getConfirmValue, message){
    return{
        selector:selector,
        test: function(value){
            return value === getConfirmValue() ? undefined : message || 'Giá trị nhập vào không chính xác'
        }
    }
}