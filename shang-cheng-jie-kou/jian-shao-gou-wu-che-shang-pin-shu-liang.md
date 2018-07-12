# 减少购物车商品数量

{% api-method method="post" host="https://api.cakes.com" path="/shop/cart/reduce\_num" %}
{% api-method-summary %}
减少购物车内的数量
{% endapi-method-summary %}

{% api-method-description %}
This endpoint allows you to get free cakes.
{% endapi-method-description %}

{% api-method-spec %}
{% api-method-request %}
{% api-method-form-data-parameters %}
{% api-method-parameter name="cart\_id" type="number" required=false %}
购物车ID
{% endapi-method-parameter %}
{% endapi-method-form-data-parameters %}
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
        "cart_id": 13,
        "goods_num": 3,
        "total_price": 239
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
    "code": 42008,
    "data": {
        "message": "请选择购物车"
    }
}
{
    "code": 42010,
    "data": {
        "message": "商品数量不可小于1"
    }
}
{
    "code": 42012,
    "data": {
        "message": "修改失败，请重试"
    }
}
```
{% endapi-method-response-example %}
{% endapi-method-response %}
{% endapi-method-spec %}
{% endapi-method %}



