# 添加商品进购物车

{% api-method method="post" host="https://api.cakes.com" path="/shop/cart/ajaxAddCart" %}
{% api-method-summary %}
添加商品进购物车
{% endapi-method-summary %}

{% api-method-description %}
注：有规格的商品需要加入商品规格
{% endapi-method-description %}

{% api-method-spec %}
{% api-method-request %}
{% api-method-form-data-parameters %}
{% api-method-parameter name="goods\_id" type="number" required=true %}
要添加进购物车的商品ID
{% endapi-method-parameter %}

{% api-method-parameter name="goods\_num" type="number" required=true %}
选择的商品数量，默认为1
{% endapi-method-parameter %}

{% api-method-parameter name="spec\_key" type="string" required=false %}
商品规格
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
        "message": "添加进购物车成功"
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
    "code": 42011,
    "data": {
        "message": "请选择规格"
    }
}
{
    "code": 42006,
    "data": {
        "message": "添加失败，请重试！"
    }
}
```
{% endapi-method-response-example %}
{% endapi-method-response %}
{% endapi-method-spec %}
{% endapi-method %}



