# 订单确认收货

{% api-method method="get" host="https://api.cakes.com" path="/member/order/confirm" %}
{% api-method-summary %}
订单确认收货接口
{% endapi-method-summary %}

{% api-method-description %}
This endpoint allows you to get free cakes.
{% endapi-method-description %}

{% api-method-spec %}
{% api-method-request %}
{% api-method-path-parameters %}
{% api-method-parameter name="id" type="number" %}
需要确认收货的订单ID
{% endapi-method-parameter %}
{% endapi-method-path-parameters %}
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
        "message": "已成功确认收货"
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
    "code": 41017,
    "data": {
        "message": "订单错误"
    }
}
{
    "code": 41018,
    "data": {
        "message": "订单未支付"
    }
}
{
    "code": 41019,
    "data": {
        "message": "订单尚未发货"
    }
}
{
    "code": 41020,
    "data": {
        "message": "当前订单已确认收货"
    }
}
{
    "code": 41021,
    "data": {
        "message": "意外错误导致订单确认收货失败，请重试"
    }
}
```
{% endapi-method-response-example %}
{% endapi-method-response %}
{% endapi-method-spec %}
{% endapi-method %}



