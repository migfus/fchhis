import XLSX from 'xlsx-js-style'
import moment from 'moment'
import { SumOfTransaction, BalanceToPay, PlanToPay, NumberAddComma } from './Converter'
import type { TGAuthContent } from '@/store/GlobalType'
import { useAddressStore } from '@/store/system/AddressStore'

const $address = useAddressStore()

export const ClientAllPrint = (content: TGAuthContent) => {
    console.log('print data', {content})
    const wb = XLSX.utils.book_new();

    let total = SumOfTransaction(content.client_transactions)
    let payment =  NumberAddComma(PlanToPay(content.info.pay_type, content.info.plan_detail))
    let balance = BalanceToPay(content.client_transactions, content.info.pay_type, content.info.plan_detail)

    const headerStye = {
        s: {
            font: { name: "Calibri", sz: 24 },
            align: { horizontal: 'center', vertical: 'center' },
            alignment: { horizontal: 'center', vertical: 'center'  },
            innerWidth
        },
        t: 's'
    }
    const contentHeaderStyle = (border = [0, 0, 0, 0], center = false, fillColor = null) => {
        return {
            s: {
                font: {
                    name: 'Calibri', sz: 12, bold: true
                },
                border: {
                    top: { color: { rgb: border[0] ? '000' : null}},
                    left: { color: { rgb: border[1] ? '000' : null}},
                    bottom: { color: { rgb: border[2] ? '000' : null}},
                    right: { color: { rgb: border[3] ? '000' : null}},
                },
                align: { horizontal: center ? 'center' : 'left', vertical: center ? 'center' : 'left' },
                alignment: { horizontal: center ? 'center' : 'left', vertical: center ? 'center' : 'left' },
                fill: {
                    fgColor: { rgb: fillColor },
                    patternType: fillColor ? 'solid' : 'none'
                }
            },
            t: 's',
        }
    }
    const contentStyle = (border = [0, 0, 0, 0], fillColor = null) => {
        return {
            s: {
                font: {
                    name: 'Calibri', sz: 12
                },
                border: {
                    top: { color: { rgb: border[0] ? '000' : null}},
                    left: { color: { rgb: border[1] ? '000' : null}},
                    bottom: { color: { rgb: border[2] ? '000' : null}},
                    right: { color: { rgb: border[3] ? '000' : null}},
                },
                fill: {
                    fgColor: { rgb: fillColor },
                    patternType: fillColor ? 'solid' : 'none'
                }
            },
            t: 's',
        }
    }

    const printContent  =  [
        // SECTION HEADER
        // ROW1
        [ { v: "Future Care and Helping Hands Insurance Services", ...headerStye }, ],
        // ROW 2
        [ { v: ``, ...headerStye, font: { name: "Calibri", sz: 12 } }, ],
        [],

        // SECTION INFO
        [
            { v: `Name: ${content.name}`, ...contentStyle([1,1,1,1]) },
            { v: ``, ...contentStyle([1,1,1,1]) },
            { v: `Registerd At: ${moment(content.created_at).format('MMM D, YYYY hh:mm A')}`, ...contentStyle([1,1,1,1]) },
            { v: ``, ...contentStyle([1,1,1,1]) },
        ],
        [
            { v: `Sex: ${content.info.sex ? 'Male' : 'Female'}`, ...contentStyle([1,1,1,1]) },
            { v: ``, ...contentStyle([1,1,1,1]) },
            { v: `Mobile #: +63 ${content.info.cell}`, ...contentStyle([1,1,1,1]) },
            { v: ``, ...contentStyle([1,1,1,1]) },
        ],
        [
            { v: `Birth Day: ${moment(content.info.bday).format('MMM D, YYYY')}`, ...contentStyle([1,1,1,1]) },
            { v: ``, ...contentStyle([1,1,1,1]) },
            { v: `Birth Place: ${$address.CityIDToFullAddress(content.info.bplace_id)}`, ...contentStyle([1,1,1,1]) },
            { v: ``, ...contentStyle([1,1,1,1]) },
        ],
        [
            { v: `Address: ${content.info.address}, ${$address.CityIDToFullAddress(content.info.address_id)}`, ...contentStyle([1,1,1,1]) },
            { v: ``, ...contentStyle([1,1,1,1]) },
            { v: `USER ID: ${content.id}`, ...contentStyle([1,1,1,1]) },
            { v: ``, ...contentStyle([1,1,1,1]) },
        ],
        [
            { v: `Due Date: ${content.info.due_at ? moment(content.info.due_at).format('MMM D, YYYY') : 'N/A'}`, ...contentStyle([1,1,1,1]) },
            { v: ``, ...contentStyle([1,1,1,1]) },
            { v: `Claimed: No`, ...contentStyle([1,1,1,1]) },
            { v: ``, ...contentStyle([1,1,1,1]) },
        ],
        [],

        // SECTION BENEFICIARIES
        // NOTE HEADER
        [ { v: `BENEFICIARIES`, ...contentHeaderStyle([1,1,1,1], true) }],
        [
            { v: "NAME", ...contentHeaderStyle([1, 1, 1, 1]) },
            { v: "BDAY", ...contentHeaderStyle([1, 1, 1, 1]) },
            { v: "REGISTERED", ...contentHeaderStyle([1, 1, 1, 1]) },
        ],

        // NOTE CONTENT
        ...content.beneficiaries.map(row => {
            let data = [];

            data.push({ v: row.name, ...contentStyle([1,1,1,1]) })
            data.push({ v: moment(row.bday).format('MMM D, YYYY'), ...contentStyle([1,1,1,1]) })
            data.push({ v: moment(row.created_at).format('MMM D, YYYY hh:mm A'), ...contentStyle([1,1,1,1]) })

            return data
        }),
        [],

        // SECTION TRANSACTIONS
        // NOTE HEADER
        [ { v: `TRANSACTIONS`, ...contentHeaderStyle([1,1,1,1], true) }],
        [
            { v: "OR", ...contentHeaderStyle([1, 1, 1, 1]) },
            { v: "AMOUNT", ...contentHeaderStyle([1, 1, 1, 1]) },
            { v: "PLAN", ...contentHeaderStyle([1, 1, 1, 1]) },
            { v: "AGENT", ...contentHeaderStyle([1, 1, 1, 1]) },
            { v: "STAFF", ...contentHeaderStyle([1, 1, 1, 1]) },
            { v: "DATE & TIME", ...contentHeaderStyle([1, 1, 1, 1]) },
        ],

        // NOTE CONTENT
        ...content.client_transactions.map(row => {
            let data = [];

            data.push({ v: row.or ?? row.id, ...contentStyle([1,1,1,1]) })
            data.push({ v: row.amount, ...contentStyle([1,1,1,1], '35ff80') })
            data.push({ v: `${row.plan_details.plan.name} (${row.pay_type.name})`, ...contentStyle([1,1,1,1]) })
            data.push({ v: row.agent.name, ...contentStyle([1,1,1,1]) })
            data.push({ v: row.staff.name, ...contentStyle([1,1,1,1]) })
            data.push({ v: moment(row.created_at).format('MMM D, YYYY hh:mm A'), ...contentStyle([1,1,1,1]) })

            return data
        }),
        // NOTE FOOTER
        [
            { v: "TOTAL: ", ...contentHeaderStyle([1, 1, 1, 1]) },
            { v: total, ...contentHeaderStyle([1, 1, 1, 1], false, '35ff80') },
        ],
        [
            { v: "OVERALL PAYMENT: ", ...contentHeaderStyle([1, 1, 1, 1]) },
            { v: payment , ...contentHeaderStyle([1, 1, 1, 1], false, 'f97e7e') },
        ],
        [
            { v: "CURRENT BALANCE: ", ...contentHeaderStyle([1, 1, 1, 1]) },
            { v: balance, ...contentHeaderStyle([1, 1, 1, 1], false, 'ffe308') },
        ],
    ]

    const ws = XLSX.utils.aoa_to_sheet(printContent);

    const merge = [
        // SECTION HEADER MERGE
        // NOTE TITLE
        {
            s: { r: 0, c: 0 },
            e: { r: 0, c: 4 }
        },
        // NOTE SUB-TITLE
        {
            s: { r: 1, c: 0 },
            e: { r: 1, c: 4 }
        },

        // SECTION INFO MERGE
        // NOTE NAME
        {
            s: { r: 3, c: 0},
            e: { r: 3, c: 1}
        },
        // NOTE REGISTER AT
        {
            s: { r: 3, c: 2},
            e: { r: 3, c: 3}
        },

        // NOTE SEX
        {
            s: { r: 4, c: 0},
            e: { r: 4, c: 1}
        },
        // NOTE MOBILE
        {
            s: { r: 4, c: 2},
            e: { r: 4, c: 3}
        },

        // NOTE BDAY
        {
            s: { r: 5, c: 0},
            e: { r: 5, c: 1}
        },
        // NOTE BPLACE
        {
            s: { r: 5, c: 2},
            e: { r: 5, c: 3}
        },

        // NOTE ADDREASS
        {
            s: { r: 6, c: 0},
            e: { r: 6, c: 1}
        },
        // NOTE ID
        {
            s: { r: 6, c: 2},
            e: { r: 6, c: 3}
        },

        // NOTE DUE DATE
        {
            s: { r: 7, c: 0},
            e: { r: 7, c: 1}
        },
        // NOTE CLAIMED
        {
            s: { r: 7, c: 2},
            e: { r: 7, c: 3}
        },

        // SECTION BENEFICIARIES HEADER MERGE
        // NOTE TITLE
        {
            s: { r: 9, c: 0 },
            e: { r: 9, c: 2 }
        },
    ]
    ws['!merges'] = merge

    const colsWidth = [
        { width: 20 }, //OR
        { width: 20 }, //PLAN
        { width: 23 }, //PAYMENT
        { width: 20 }, //AMOUNT
        { width: 20 }, //DATE
        { width: 21 }, //DATE
    ];
    ws['!cols'] = colsWidth;

    // ws["A1"].s = {
    //     font: {
    //         name: "Calibri",
    //         sz: 24,
    //         bold: true,
    //         color: { rgb: "FFFFAA00" },
    //     },
    // };

    XLSX.utils.book_append_sheet(wb, ws, content.name.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, ''))
    XLSX.writeFile(wb, `${content.name}_${moment().format('YYYY-MM-DD_HH-mm-ss')}.xlsx`)
}
