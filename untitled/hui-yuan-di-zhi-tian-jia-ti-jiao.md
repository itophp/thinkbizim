# 会员地址添加提交

{% api-method method="post" host="https://api.cakes.com" path="/member/address/save" %}
{% api-method-summary %}
收货地址添加编辑（编辑和添加地址传入数据相同，但是编辑地址需要多传入一个当前地址ID）
{% endapi-method-summary %}

{% api-method-description %}
This endpoint allows you to get free cakes.
{% endapi-method-description %}

{% api-method-spec %}
{% api-method-request %}
{% api-method-body-parameters %}
{% api-method-parameter name="is\_default" type="boolean" required=false %}
是否设置为默认地址
{% endapi-method-parameter %}

{% api-method-parameter name="id" type="number" required=true %}
收货地址ID（编辑地址时使用）
{% endapi-method-parameter %}

{% api-method-parameter name="consignee" type="string" required=true %}
收货人姓名
{% endapi-method-parameter %}

{% api-method-parameter name="province" type="number" required=true %}
收货省份ID
{% endapi-method-parameter %}

{% api-method-parameter name="city" type="number" required=true %}
收货城市ID
{% endapi-method-parameter %}

{% api-method-parameter name="district" type="number" required=false %}
收货区县ID（不存在填0）
{% endapi-method-parameter %}

{% api-method-parameter name="address" type="string" required=true %}
收货详细地址
{% endapi-method-parameter %}

{% api-method-parameter name="mobile" type="number" required=true %}
收货人手机号码
{% endapi-method-parameter %}

{% api-method-parameter name="zip" type="number" required=false %}
邮编
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
        "message": "收货地址保存成功!"
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
    "code": 41022,
    "data": {
        "message": "错误提示"
    }
}
{
    "code": 41023,
    "data": {
        "message": "收货地址数量已达到上限"
    }
}
{
    "code": 41024,
    "data": {
        "message": "保存失败，请重试"
    }
}
```
{% endapi-method-response-example %}
{% endapi-method-response %}
{% endapi-method-spec %}
{% endapi-method %}



