# 登录接口

{% api-method method="post" host="https://api.cakes.com" path="/member/login/dologin" %}
{% api-method-summary %}
用户登录
{% endapi-method-summary %}

{% api-method-description %}

{% endapi-method-description %}

{% api-method-spec %}
{% api-method-request %}
{% api-method-body-parameters %}
{% api-method-parameter name="username" type="string" required=false %}
登录账户，支持  邮箱，用户名，手机号
{% endapi-method-parameter %}

{% api-method-parameter name="password" type="string" required=false %}
登录密码
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
        "id": 14,
        "nickname": "13332947382",
        "head_pic": null
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
    "code": 41013,
    "data": {
        "message": "登录失败,请检查用户名密码是否正确"
    }
}
{
    "code": 41014,
    "data": {
        "message": "请输入登录密码"
    }
}
{
    "code": 41015,
    "data": {
        "message": "请输入登录账户"
    }
}
```
{% endapi-method-response-example %}
{% endapi-method-response %}
{% endapi-method-spec %}
{% endapi-method %}



