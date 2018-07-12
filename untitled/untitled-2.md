# 会员地址列表

{% api-method method="get" host="https://api.cakes.com" path="/member/address/index" %}
{% api-method-summary %}
获取地址列表
{% endapi-method-summary %}

{% api-method-description %}
This endpoint allows you to get free cakes.
{% endapi-method-description %}

{% api-method-spec %}
{% api-method-request %}

{% api-method-response %}
{% api-method-response-example httpCode=200 %}
{% api-method-response-example-description %}
Cake successfully retrieved.
{% endapi-method-response-example-description %}

```javascript
{
    "code": 200,
    "data": {
        "addr_nums": 1,
        "lists": [
            {
                "id": 2,
                "user_id": 2,
                "consignee": "吴跃忠",
                "company_name": null,
                "mobile": 13267057693,
                "phone": "",
                "email": null,
                "country": 0,
                "province": 19,
                "city": 236,
                "district": 3184,
                "address": "龙华新区新区大道新景大厦510",
                "zip": "518131",
                "is_default": 0,
                "is_pickup": 0,
                "status": 1
            }
        ],
        "page": null
    }
}
```
{% endapi-method-response-example %}

{% api-method-response-example httpCode=404 %}
{% api-method-response-example-description %}
Could not find a cake matching this query.
{% endapi-method-response-example-description %}

```javascript

```
{% endapi-method-response-example %}
{% endapi-method-response %}
{% endapi-method-spec %}
{% endapi-method %}



