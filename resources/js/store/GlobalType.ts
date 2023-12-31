export type TGConfig = {
    loading: boolean
    form?: string
}

export type TGQuery = {
    search: string
    filter?: string
    sort: 'ASC' | 'DESC'
    start?: Date
    end?: Date
}

export type TGAddress = {
    id: number
    name: string
    cities: Array<{
        id: number
        name: string
        zipcode: number
    }>
}

export type TGPlanDetail = {
    plan: {
        name: string
        id: number
    }
    monthly: number,
    quarterly: number,
    semi_annual: number,
    annual: number,
    spot_pay: number,
    spot_service: number,
}

export type TGPayType = {
    name: string
}

export type TGAuthContent = {
    branch_id: bigint
    branch: {
        name: string
    }

    region_id: bigint
    region: {
        name: string
    }

    avatar: string
    created_at: Date
    email: string
    id: bigint
    role: string //DEBUG UNSORE
    name: string
    info?: TUserInfo
    roles: Array<{
        name: string
    }>
    logs: Array<{
        content: string
        created_at: Date
        id: number
    }>,
    beneficiaries: Array<TBeneficiary>
    client_transactions_sum_amount?: number
    client_transactions? : Array<TGTransaction>
}

export type TGAgent = {
    id: number
    name: string
    created_at: Date
}

export type TGTransaction = {
    id: number
    or: string
    amount: number
    created_at: string
    plan_details: TGPlanDetail
    pay_type: TGPayType
    agent: TGAgent
    staff: TGAgent
}

export type TUserInfo = {
    staff_id: bigint
    staff: {
        name: string
    }

    agent_id: bigint
    agent: {
        name: string
        id: number
    }

    pay_type_id: bigint
    pay_type: TGPayType

    plan_detail_id: bigint
    plan_detail: TGPlanDetail

    bday: Date
    bplace_id: bigint
    sex: boolean
    address_id: bigint
    address: string
    due_at?: Date // null = no due
    fulfilled_at?: Date // null = not claimed
    or?: string // null = no initial OR number
    cell: number
}

type TBeneficiary = {
    name: string
    bday: Date
    id: number
    created_at: Date
}
