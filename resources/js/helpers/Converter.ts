import type { TGPlanDetail } from "@/store/GlobalType"
import moment from 'moment'

export const NumberAddComma = (num: number)  => {
    if(num) {
        let _num = Number(num).toFixed(2);
        return _num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    return '0.00'
}

export const NumberToOriginal = (num: string) => {
    if(num) {
        num = num.replace(',', '')
        return Number(num)
    }
    return 0
}

export const PlanToPay = (pay_type: {name: string}, plan_detail: TGPlanDetail) => {
    switch (pay_type.name) {
        case 'Monthly':
            return plan_detail.monthly * 60
        case 'Quarterly':
            return plan_detail.quarterly * 24
        case 'Semi-Annual':
            return plan_detail.semi_annual * 12
        case 'Annual':
            return plan_detail.annual * 6
        case 'Spot Payment':
            return plan_detail.spot_pay
        case 'Spot Service':
            return plan_detail.spot_service
        default:
            return 0
    }
}

export const PlanToAmount = (pay_type: {name: string}, plan_detail: TGPlanDetail) => {
    switch (pay_type.name) {
        case 'Monthly':
            return plan_detail.monthly
        case 'Quarterly':
            return plan_detail.quarterly
        case 'Semi-Annual':
            return plan_detail.semi_annual
        case 'Annual':
            return plan_detail.annual
        case 'Spot Payment':
            return plan_detail.spot_pay
        case 'Spot Service':
            return plan_detail.spot_service
        default:
            return 0
    }
}

export const SumOfTransaction = (trans: Array<{ amount: number}>) => {
    if(trans) {
        return NumberAddComma(trans.reduce((added, row) => added + Number(row.amount), 0))
    }

    return 0
}

export const BalanceToPay = (trans: Array<{ amount: number}>, pay_type: { name: string}, plan_detail: TGPlanDetail) => {
    if(!trans) {
        return '0.00'
    }
    let payment = Number(PlanToPay(pay_type, plan_detail))
    return NumberAddComma(Number(payment - trans.reduce((added, row) => added + Number(row.amount), 0)))
}

export const DueStatusColor = (dueDate: Date, target = 'text') => {
    if(moment().diff(dueDate, 'months') >= 1)
        return `${target}-red-500`

    else if(moment().diff(dueDate, 'days') >= 1)
        return `${target}-yellow-500`

    else
        return ''
}

export const DueStatusDesc = (dueDate: Date) => {
    if(!dueDate)
        return 'N/A'

    if(moment().diff(dueDate, 'months') >= 1)
        return `Overdue`

    else if(moment().diff(dueDate, 'days') >= 1)
        return 'Grace'

    return `${moment().from(dueDate, true)}`
}

