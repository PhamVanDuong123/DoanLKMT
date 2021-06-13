<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_images')->insert([
            [
                'url'=>'https://lh3.googleusercontent.com/Ign4lpjArSiidNRRHYM9j8CFevQ_4SZSoawNYfPi-8G4k3KVbcxsug1jDrLksg13PrTSUGvWly_dOZw2nrPj',
                'product_id'=>1,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/a7wxofKTqJFpTT-PXEXtBFu_c3JOshhIr_wL2JWBCPuvljmDirb7fzTle9CTueHARNLanM00SepijWjNjYw',
                'product_id'=>1,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/R7ReWmjRPltJPq8ofoCc-vIHl9mfaRNksAZ8AGgL4s6jqB7AU11-LSC7qh1S0IqyG08MTma99AA78RkpYg',
                'product_id'=>1,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/xGsY5yO53sWLLYGXLdEwn2A0Gsqi4ovNpNLj64rNHusbe2NkdJrTQ-orN5iGLR0jfSP79fwwdkoug8cgigLgGE0NcSZGT2dBBw=w150-rw',
                'product_id'=>2,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/5Kuhxrls3aLQAeFbhkCDkYrRFmxclICT711xmSXsUYSlZ1gSRZ44kQoDIAvAlPTQL-D8T59MrTv-p0OO4eF9UihrtmAVYmg=w150-rw',
                'product_id'=>2,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/CyZ5ggHqkHt250oUhZGafEQ0wpHWMuOy0CMdBdzHbMGRUOwhhsnCqq-LM22HZDtJJ1aw5vKL-hcdI7puEo0HiRoZS-ySQBonQw=w150-rw',
                'product_id'=>2,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/HNryB1uLW0LmY9sa_I0r-hWoeaLDJ2dcBCt8Hgxt68xJrdpeidsufJ6VYcBZq6AGl1vlEz5bs7Qf-XlEESI=w150-rw',
                'product_id'=>2,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/AJgu_5i6l-FfTXi7ElU6t1KOqkwsBjtkfbZp43KXPbkJWCV4-cUnEF-mb6JWQzsw-yAhTZK1fkQJQZkExtjk=w150-rw',
                'product_id'=>2,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/R1U0dAMRdCEYUNzTS3xXpDlz2eJlRSiuqtrHmMboDQAZokUKrIGnDFHGmmoN-uQHDf-7tE_3OZuqcjLCUZwNLDKSBS2hxa8W',
                'product_id'=>3,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/xfmEDqPoUPVTuwJpTEcJW_Umbvwgft67soB0dzBfJmZ0HMP4Xnh5mBytC6GXwtKdd1CxUs0Gg_63onHgREHxMHzpG0QUJLN1=w150-rw',
                'product_id'=>3,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/0g3jL9gcr1QCuBeKDVjAjGWVv7IuycCn5caE_jYm6sntPi1nBLV3IIUZ3epL9ZTU7sRY8CRML2qVGUVFVQXI3x8WKAG51-ft=w150-rw',
                'product_id'=>3,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/TBjy0T3LQ7f5MtFYp4ycC3YKWkMnZlFqxLXtZViCXEseP-IdAihHq6xgdNB4FHVHaBcY-8fFEtcgOu69yiyMslxUEzYEZDM=w150-rw',
                'product_id'=>3,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/EGI1Uvdmw0PR04pCiwzZqek98ZwfvAltKJfNLbbQk-x9JQHlEstI-6fEwHFVCD38H04gtb07t8Tcm5gmqkqM=w1000-rw',
                'product_id'=>4,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/JCJzwKOMUKbkocUJwhcEqIaplaqnQ9n1jYcDEzMGcMQik6Jvh9CCLwDBIy1OzlgIQJSEhkitOI2W1ZqW8dw',
                'product_id'=>5,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/zBtRdsoxP9zSiDyMPPhEAfrZ0EiWa5qwQN-pxv-qgDzDvozqqZ7ImMFambvwubH4-Rm4Ml42pKhzk_bDmphw=w150-rw',
                'product_id'=>6,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/2sgZqwtyNDHC2fo1Obyxgyft_8a0Ym_O-LWu2JOxquNAPcmpPU_xkeSrzylLJtM4rfkdZpWk2k2uliehuNNYF5ofqb2rhuU=w150-rw',
                'product_id'=>7,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/lF_kU_IlbKXFhCmlx0xK75WJnE7PeHw5TmwivehGy5GSBelEE_69OlgfgNvEMt8_wO5lwdG0oN5lqr3uiCxp0NViPE7OHeRb=w150-rw',
                'product_id'=>7,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/Hv_QSEPcYcFkF414c6IM3nkJ1kq-ft-zf8Hky4VCB4bV2vgROSKUdBTRholISnFWdeAZCaxn9rqpS9S-ig=w150-rw',
                'product_id'=>8,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/xvVQlmGqQ4p4FK-3ARZbpX5f5hEZ2_kRKczZSWpa4_EfadOn9E41QJ7Wn44FgDhjYNz_Wqug8CD9Sk7xyuA=w150-rw',
                'product_id'=>8,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/QhaQoeM1cpPzQKHYMPgv0ZNMzIGdj3C6A8qp8lI93bGTwJ09XBQAJhXvhAy8ksbk2x4LGS1g7ZZMzsbZKg=w1000-rw',
                'product_id'=>8,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/z6P6R9N68-Yay7REAUvHm-eakHe8uaCfTBsTdvskJxinErJh3le5DJrMQPBQKXNTmW8bRSySzeZygFvR3dc=w150-rw',
                'product_id'=>8,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/GeWeQsrMPQS5uxPB5h_-ZNcYZ9Pci63APUTZKSsdJ1r4nZMNX8gtR1GMtX1JMOjlB3cvBIt4Jpmt824EUIQ=w150-rw',
                'product_id'=>8,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/eCjhTTh0FLWYQMEPjCKsm5EEp_H5tY4997yC1ofu1DDZlAJxzz5oA3uKIaldcMvujMkzA8siabmL7pCRxG9M=w150-rw',
                'product_id'=>9,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/QcKW8_MEhJhvJ9YUZIO8hsWg2tDhDCYamRPuU57jIDWQnMrAaOwcT-bU-HvOYtS0XM4yKbGsDVlXtxUb-w=w150-rw',
                'product_id'=>9,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/GspstRuVBedfNQs0hvvJISOYxrQ84HVwbJuvJBSxZNAvACh9oW8P7ndsWlabH0C-UsK7jsYMwA1lrekR5U0r=w150-rw',
                'product_id'=>10,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/iTGf5B0UVbFDuW17fW1at4L5OZVi4xdAEVe6LH9Y6fdQmShLTViymzWedN2y3BSLuPygwM79Tg42X3xjJ54=w150-rw',
                'product_id'=>10,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/UMa36MlAeb8jh1vS9TVsQ44s783vPG6YH62RPvbO7pORZm5CnEaiCqsHunfLX4aaXpIoSj8yc2DBUthAFM82y2G-MfW-fY_e=w150-rw',
                'product_id'=>11,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/itoWpSPNix5fNSyalNwp8iQ-lQGxGWp0QXxSK4LCebWbDXgTwGb_Ndw-lqJsKgbBOeujK3ieE1K5pSInr_en-5zIdiNaQ7kt=w150-rw',
                'product_id'=>11,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/K4qOOVyQW0H36BXAGXYQe4Mm-cfnCCh_ZFRbedx9wINErgQfwOFLUhdGy7km-Ijw4LYtzqcgU5eFPO_6lp0BqBwIgemIJDA=w150-rw',
                'product_id'=>12,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/3aBodHAMeSIBCpiqOoV--1IOJ1uiH_6q9saRZ17d64HOfAbhSK3XEg27ehVduuS-n8HRfVyQ09Dvrrsml2QNwU1_TyHVN-zGTw=w150-rw',
                'product_id'=>12,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/T93_Rl3FeI5eSQTmbNiA45UajxIsTD-nIm29DQ1sRKSCHj5Y7Efht8CWxN2OIXND0cQwbJo4mX2ZPEs1Emo66iwxLj83mPvx=w150-rw',
                'product_id'=>12,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/5ExhSrMM-ES62Xlp6mbLriUJypxCSFntT-cGnOCWbxzMHjOW6LlFqcguBje5_7RlpuG7WIClGohbL3Bs12S9OREg5lKNfO4=w150-rw',
                'product_id'=>12,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/2BIIyljq7ed3l2HbzypjO-aUT19iBr5HJrFiCKjdCydtzDLpwgCTivAcmS4BIeuKXW2vtiyfgyn0x8CuMXJRtBSmcX4Ji00=w150-rw',
                'product_id'=>12,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/zDArdZ5S6IiVQQwUlG_htF8O34qUxYVHotu8UMKv-8xa-zpcUhKBXtPEufaMe7xc9h_LmDdDtskBofL3ICT2mScBr1RPGMEKwA=w150-rw',
                'product_id'=>12,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/yPLY4fD-O5PkVQc25Ld9WnXjQVqjWCuZjHqwO2BgaZq-mQGIWViIMTuqdbNQVGohx-GSX_lqJ_om14P3KLfE4YlAKBuWnCs=w150-rw',
                'product_id'=>13,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/GGcyaNFgm55W-UONx69KlUvw3G2dny9Jt8N3AYrEk_mxrs4F5g4XGS2Inm5eKJAF5oB4Ay95HKp5g_EDpy5oSRUTKfBOhJx_=w150-rw',
                'product_id'=>13,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/scmKwuf4IyaEt_qAeWINaw-VvQ-rM9Jgs62eVD16X61882g72Cb6I_Zv4erJX60304xYqrQG7e43brZwhrYF_MOAS1W8Pmg=w150-rw',
                'product_id'=>13,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/LQkmKBe9pABOZbR8laA8YMfJhYONGUvDOhw9n_7-dLy0m5xIbslIisMtqpQgHz2puhY2WpbyguDbI3ojoUODwW5e1wlZhQw=w150-rw',
                'product_id'=>13,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/4fouDX7q5u_9DNlRZaj3RcWmQd7ypue4Irmhzvt83VMbSwHlo3U_blM3up3TmJGNPwBgAQ7wjecNIP3OJP4PaRa4xAB80C4V=w150-rw',
                'product_id'=>13,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/NvzEAXh8R6JdybqDj4djxJN817nAGaLNYnACFfylsTERKwoOs7F6ONWxUrjtM8YVcai_UX9CkDVIr0i9W4F_QHQJ_c-n9cxP=w150-rw',
                'product_id'=>14,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/ZC48ql1aMapR2W3WqrA4fvhiUtU9UKzN1gabgDAaBS0OBvwGjlM-Z4-QTwOsoQEnKsY2nMDgij6vQPztoBecYSetkFk9ONzV=w150-rw',
                'product_id'=>14,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/XytHys0SOowbV0qLxCEJFjxPrLKti6l8R_LJyyj7D2Ack4q-01V-jGs-m6Yz1yzTuVH2D_8ajCrs2X4csoKFa7r-_xdEWytG4w=w150-rw',
                'product_id'=>14,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/v7CU2mhp9tx02o3mnQKREmgbdQCM5s-F3TcAdUTLnZs5hLQrApK9Po7LXzrzQesCbXnVSEWJmEP9_iDrRLRmjO1BuMRb_ICKig=w150-rw',
                'product_id'=>14,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/mqg7hGMszwbWAU6TNnkrBtei9ML-KvTeFJgyzZzTq80h0q8sp74L_4cxwg2udnxcqpnvz5VbMzM_hyVZcohWqdh8_015uQLy_Q=w150-rw',
                'product_id'=>14,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/gNwtq_YrR9cimqW1nVW7LBYeRbASj2T81D0S3z9cn_-IMVt7NL1dQJr3gtfLaAze7NC7klFwhNpc0-zrAqNWa9qPXfX1_wXOtw=w150-rw',
                'product_id'=>15,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/Bd073c1wZVt8Oxq8CnsCcwyOSWINSg4ayt-Z_5MSrzQwEZdBvA2bOPML5lG-87UOmVhgIYMPqMTV3SU1vd79ysz7vwTo4z0=w150-rw',
                'product_id'=>15,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/CrCot_OsThL3p3Pd6Q2SZzmjSEN0JrzML-_VzvrUv-7KkuH5OoLq3tRAwunAWVncfYW8hg3ilz6eyXtoZlXdzDodsWvVX8lZEQ=w150-rw',
                'product_id'=>15,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/2dsOB1eHL1pDcepAyiHO1171RspKUbhMyDwpUcn08lFp3R2fvtelz7-g_ACL4mfx61hU6CKC16SKQTEEwdPDrxHQtkqU-htRrQ=w150-rw',
                'product_id'=>15,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/avhl8pLNqvJ9wQFMaYPFarA4HXI7NmK_tp95SmLodmuA6mZg5VxvCMRHijOYi739KTt3xcL7ooqUDP10u0MDpFD-DnCiqJlb=w150-rw',
                'product_id'=>15,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/vNtFRStUdMu5Q-JckdKtXuLhIVVDs9Y_RO1iqi7Y9lmfGdpOFdm4LMu7cblJ_ZF3ZAfO2n0gNJT03T4dc2IG0FOyxdbQPqs=w150-rw',
                'product_id'=>15,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/PvmAZg9Vhnqly3tXQaFrSu9x_EUGgNcNv3L_Jr48IAb0Zf4vTJlCecqkUQ5GaSRdqggEC_Dp_jcwI2hfumY=w150-rw',
                'product_id'=>16,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/x80DWI3p3yErm4Aon4EvN0tklIdrcWMrM0ISYOGx12xJ_vGNaTwz-kqdfm7-lf18bw1GpVZEv4k968aStkU=w150-rw',
                'product_id'=>16,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/WjBuM5p1ql_uyLzzbT4f3wW81Oq4mEKQeBNWi7SH5Ba9ib_Kz6wXTram2K7iV8JYCsO_zJxh99JARYW76gI=w150-rw',
                'product_id'=>17,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'url'=>'https://lh3.googleusercontent.com/QA8zKiKEObaQ8mWHE4j4DxeW4x2eFKvfyOfmDTEY0BpM9W_akhU5yuvLMsBSV6dt8i-m45efg03-biq1pck=w150-rw',
                'product_id'=>17,
                'created_at'=>date('Y-m-d H:m:s',time())
            ]
        ]);
    }
}
