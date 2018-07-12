# 商品评论列表

{% api-method method="get" host="https://api.cakes.com" path="/shop/goods/comment" %}
{% api-method-summary %}
获取商品评论列表
{% endapi-method-summary %}

{% api-method-description %}
This endpoint allows you to get free cakes.
{% endapi-method-description %}

{% api-method-spec %}
{% api-method-request %}
{% api-method-query-parameters %}
{% api-method-parameter name="goods\_id" type="number" required=true %}
商品ID
{% endapi-method-parameter %}

{% api-method-parameter name="page" type="number" required=false %}
当前分页，默认为第一页。一页10条
{% endapi-method-parameter %}

{% api-method-parameter name="type" type="number" %}
评论类型  
1、全部   2、好评   3、中评   4、差评   5、有图  
默认为1
{% endapi-method-parameter %}
{% endapi-method-query-parameters %}
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
        "commentlist": [
            {
                "id": 38,
                "goods_id": 891,
                "spec_key": "2095",
                "spec_item": "용량:1TB,",
                "email": "",
                "user_id": 4174,
                "username": "전설매",
                "content": "배송이 좀 느리지만 가볍고 좋아요 ~",
                "deliver_rank": 3,
                "goods_rank": 3,
                "description_rank": 1,
                "service_rank": 4,
                "add_time": "2017-11-09 15:56:36",
                "parent_id": 0,
                "img": [
                    "/uploads/comment/20171109/239feb83b27cfa41bc900c926e3813b7.png",
                    "/uploads/comment/20171109/239feb83b27cfa41bc900c926e3813b7.png"
                ],
                "reply": []
            }
        ]
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
    "message": "Ain't no cake like that."
}
```
{% endapi-method-response-example %}
{% endapi-method-response %}
{% endapi-method-spec %}
{% endapi-method %}



