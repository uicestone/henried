course          课程
    *post_excerpt 课程简介
    code        课程代码
    duration    学习周期
    sections    章节详情
        Title | Qiniu Video Key 1 | Qiniu Video Key 2 | ...
    comments    评论数
    sells       销售数
    stars       评级

course_order    课程订单
    amount      金额
    currency    币种
    *post_date  订单日期
    course_id   课程ID，可以为多项
    user_id     用户ID
    *author_id  销售人员ID

*user
    ordered_course_id   已订购课程，可以为多项
    learned_section     已学习章节，可以为多项，每项格式如{course_id}-{section_index}
