# 发送手机验证码

{% api-method method="post" host="https://api.cakes.com" path="/member/login/send\_sms\_code" %}
{% api-method-summary %}
获取手机验证码
{% endapi-method-summary %}

{% api-method-description %}
This endpoint allows you to get free cakes.
{% endapi-method-description %}

{% api-method-spec %}
{% api-method-request %}
{% api-method-body-parameters %}
{% api-method-parameter name="mobile" type="number" required=false %}
需要获取手机验证码的号码
{% endapi-method-parameter %}

{% api-method-parameter name="captcha" type="string" required=false %}
图形验证码
{% endapi-method-parameter %}
{% endapi-method-body-parameters %}
{% endapi-method-request %}

{% api-method-response %}
{% api-method-response-example httpCode=200 %}
{% api-method-response-example-description %}
Cake successfully retrieved.
{% endapi-method-response-example-description %}

```javascript
{
    "code": 200,
    "data": {
        "message": "验证码发送成功，请注意查收。"
    }
}
```
{% endapi-method-response-example %}

{% api-method-response-example httpCode=404 %}
{% api-method-response-example-description %}
Could not find a cake matching this query.
{% endapi-method-response-example-description %}

```javascript
{
    "code": 41004,
    "data": {
        "message": "请输入手机号码"
    }
}
{
    "code": 41005,
    "data": {
        "message": "请输入图形验证码"
    }
}
{
    "code": 41006,
    "data": {
        "message": "手机号码格式错误"
    }
}
{
    "code": 41007,
    "data": {
        "message": "图形验证码验证失败，请重试"
    }
}
{
    "code": 41008,
    "data": {
        "message": "验证码发送失败，请重试"
    }
}
```
{% endapi-method-response-example %}
{% endapi-method-response %}
{% endapi-method-spec %}
{% endapi-method %}



