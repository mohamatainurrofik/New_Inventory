<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Aloha!</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }
    </style>

</head>

<body>
    <table width="100%">
        <tr>
            <td valign="top"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAANIAAAB8CAYAAAAcj+7cAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAABmvSURBVHhe7Z0HdFXF1sd3bgopSI9SLIhKEcSCiICAIlYUFcS6fCqgiOXD9VAsD78lSx8PK4I8pchT1A97wYaKdB41dBEJiDSlhZAE0m9yvvnve+Zm7sm9NwmZBFxr/7JmnXPm9HPmP3vPnjk3MY6CBEGoFj53KghCNRAhCYIFREiCYAERkiBYQIQkCBYQIQmCBURIgmABEZIgWECEJAgWECEJggVESIJgARGSIFhAhCQIFhAhCYIFREiCYAERkiBYQIQkCBYQIQmCBURIgmABEZIgWECEJAgWECEJggVESIJgARGSIFhAhCQIFhAhCYIFREiCYAERkiBYQIQkCBYQIQmCBURIgmABEZIgWECEJAgWECEJggVESIJgARGSIFhAhCQIFhAhCYIFREiCYAERkiBYQIQkCBYQIQmCBURIgmABEZIgWCDGUbjzx5RSdRWFJSWUWVBK6w/4aX9REcWo/FTy02kNkqhFgwRKjo+leB9yBeH44pgKqcBfSst35tBDy3bQxsx6KqMBUWwJUdwhIqdIqau+miZSQixRw8RiSijMosZNEmhIhxTqe3IKnVo/hXw+MarCseeYCGlLRj61nrFNOZZ13RwXiCcmrkxQsftoSMNfqHOjXdSizgY6KeE3SvIpkbmUxLehZs3upcbNupAvTokuJt5dIwi1S60KaVdWIZ363k4if8NARnxuQDxYVqJhYRXUo8YJ62nESe/TJafsp46xaZTk30sJvlLepag0YIESStWy0pzy/KhIWaX8uKaU2PxxSmhxH8X4UngbQagtak1IDafuoKz92UT1leXwK18NxCmrU6wKPQRFShjZh2lo09n0YLtp1NbZHBCPKxTA4vGixARxYV2e2jYuwUfO6R9RneYD1EppTwm1Q40LaddhP/WYvpX+UC6bvzgxIB4vEFPen/RW+6l0a6s3qc6BwDZOYsDSFPvrK7FsopSE5pxvgnUUE0vxsZkUr47BecnNaY/Tktp2ma/WVc7dy8jIcOfKU6dOHTrhhBPcpQBFRUWUna0qBoNGjRpRbKxbSSgOHz5MBQUFFBMTQ3jMmDZu3JinJiUlJbR79246cOAAxcXF0cknn0xNmjRx10YG++3du5evD9dz0kknhZy/NkhLS6OlS5fyfIsWLah///48XxXwjIDf76e6dcvc/R07dtDHH39MCQkJfH+PP/64u+b4o0aFlJ6RR1d+lU17c0up0MkKBA9i89VZE9Ra17r4VUH3ZdP0di/S3+q+S3nqmcKqwMJk+NpR/U6zKD7x5MC2FaJuhe8mcEtFBbt5mpB0Ok+j4S3cXpKSkigzM5MSE1VloJgzZw716dOH5zVjx46lJ554gufxWMMFQrKyspRRVs/BBQWxc+fO7lIZOB/EnZyc7OaUZ/v27XT66WX39vvvv1PLli3dpZoDBR8iTklJofHjx9Ojjz7K+b179+bnUhVQGTVooNrELhCTrgxWrlxJF110Ec8DnPN4DS7V2FVtPpBHV327n/bnKRGVqIINEWlrBNfOUX4Yp8SgiODGwZpoETW+aLES0WlqBzzYyiTl5yFYASukki++hDLSWpFTckStqx75+flscTSoJb08+eST7hxRYWGhOxeKaTHWrFkTVkQA50NBLQ3nzkYgPr7mgy1DhgxhkcNyeCuLnTtV+7eKRLOg3mdYg3V+takRIe07UkR9vt5Ne3LiKd+vbj6u2F1jUJLEaXjDSXRb8vtUnKdqJ+W6JR/5k9s6jbuuUlooK7hHg6/0BGqgjnV4DQpr9Jdg1vxDhw6lzZs30+rVq+mKK65wcwOFG+5aNOCCgE2bNvE0EqhdL7jgAncpAM65ePFidynAlClT3Dm7QKCVLZi4VnDw4EGaNm0azwNY8UceeYSt7P79+2njxo3umlCwvz6GF29FYW53ySWXsLt76NAhOnLkSETRRTq2Ce61KpVSVbEuJLyazh8dpIy8FCokpQ5thbSY4NYhT1miC044QiPPeIaz0R6CiIrVFSX3yKYYnxJaNXF8eRSvnl1iYToVZi1wc8NjFqrrrruOWrduTeeffz7NmDEjxO2r6GWgrQMWLlzIUy/6POvXr+ep5tdff+Vzdu/enb7++ms3l2jYsGHuXHkqcke9oIZ/5plneD8USliT++67j3Jyctwtyvjjjz+4EsG2aLdhqtttq1atYvGAb775hp/Xbbfdxsc2wX3o/ZFQWc2cOdNdSzRu3LgQNxc0b96cTjsNXgjRli1b2GIPGDCAbrjhhpBnj+c4ceLEkOt75ZVXylUOcH979erF94p7xnYvv/yyfVGpE1tl5JzdTuKEDIfG7XJo/M8Ovb5Npe2epPJePeD888O/O84ScrKWNXeKfiIndy45Rfk73SNVn5Ki/XxcZyE52StbO05psbumPMpdwRvgpB60oyyPo/x356WXXgrmI6kXwNsroQTznn766eC8ajPwer08atQoR7284LIqtLzee1xVq3I+ULWw06lTJ0cVck7mOhNVSEKOoUTsrimPam+FbOtNSjjulo6zbZt6P8a6wYMHO6mpqcFlJRB3S8d59dVXg/k9e/Z0cx3n3nvvDeZ70x133MHbDBo0KOx6JKBc35A81X7ifDwPM99MeNb6Hak2VthtdFLeA29nA6tCyoQfpwTCIjKFg+VgXpmwfl7UgYVUuNjn5M7vrMp5lnskO5QUHWBxQkiYFhya764pjymkcKl9+/aOcu3crR1n0aJFwXXKmgTnr7zySic3Nze4DDGaQoJAgbI+wTyko6EqQjK3u/vuu1lYELmZrwtgnz59gnlvvvkm53mFqMWN9TpPC0RZq2Be7969HWUJudC+9tprLLwff/yRt8P1TpgwIbgt0meffcYCAGlpaSHr9PWhojPz586d61x22WXB5U8//ZS3M7dRricLEe9NtfMcZUn5PdnCqmvXaMqvgT4hb4gby9q1K1Xunj+Wevo201kxv3CAASFuOvU8Ki3YQ/7DG8ifvUClNJVWlaWcNSqtVWmJSusC89mLiIozA8eNAvqhEAnMTf+Hm1N14HJE8sURKXvggQd4XhUS6tGjB8+rgsqhafWceRnAtQDp6ek8rQ0QRjZRFpTD8F63UV+T2RY58cQT3bnwFBeXtX/RngFoz2gQlXzuuefoq6++oquvvpqGDx8ebHciXK4sF88DPJubbrqJLrzwQjenPHiWjz32GM9jeyU8UiKi999/n/MQCJk1a1awraoZOXIkvfXWWxwkef3116lv375RI6JVxZqQikqUz3k4fEELYJxKCatdnQ3c4YrAAkYu0PapVLiyHTkrOpKTdqlKnVW6sCytvECl86loVXc1VaLb0ImKVvekwn0/uAetmLrFgf6OirjnnnvYv1c1G1166aWcN3v2bH4Jus9DCwLA/0aAQoMgBcAL9qJFdc011/C0Nvjhh9BnpKOPiAqabNiwgafou9GgfXL//ffTWWed5eYEwvw6WmdGL9GPBZo1a8ZTgPbX888/TzfffDO1bduWRTpp0iR3bflAgdl2MQWtn7c32NOhQwee6oouLy+PBYPrMoM577zzDld2aPdCbKjszHNVF2tCWvi7anymVBBl0yMa1PSUlD/YGsFSAEyR4t33guBDuKS3R4g8OU7tV68VL1eWYn9ACNHAS0cDGoUIAjJF8+233/LUzMMLPPPMM92lMlQ7p1xB0UK68cYbeaoxXyr6j3B8NO5Ra5oWzcS8BuBd1ng7d/XxzNA10BalXr16IZZi6tSpHDnr2LEjrVixIthX5mXfvn08xXERdIlU48MS6som0jWDSB5AJLz3M2/evLCVGUB0FKF8W1gT0phlB1H63aUocGesixKCv6g0ZOgP3LC8uoG+pHAJbmC8ej+8nRJisT90dEEkcB6wNyfyCAaN6RagcJkFWRc2L2aPvAYFMhLa0mnmz5/vzhFNnz6dpwg3I+QerbCZIAQNcL1IWpy61tbo+/NG6y6++GKeouZ+++23eR6RPn28devWlev3Mq9NWyQAtw3WA24eOorhgqFi0XzyySfuXGQQjfMCa2KydetWnuoRJKqdxiMgcO94/qgIEWFEVBSWULVheXuAe7RllawJaV6WumkeM1cB6DBVgsunVF40LYxOcPUglHAJ69DnFMSp3IOA9QI7c0N953DceeedXPumpqayy2CiazhTXBq0PTS33347v9hILwqhbrNQXH755exSwvXQbQCA3v3Kgn1xTtTMSHCNUPhxLpMPP/yQr+vzzz93cwKcd9553OaZPHmymxO4zkGDBtGDDz7I4W0URoSUw6GFjJC4Hi6FMDrakBg6NHr0aF4PTj31VHeuDDzTZ599ttx1maDTGa4mwPbwHJYsWRIcXfHBBx/w+SBiPAuIEa5eq1at2P027w3P32vFjhp1MdWmwF/q0IR0N9wdiMhFToHQ99C3Xg5G7JAQWUPSy5VNeRnfuVdRHoS/Ea3DdgiDYzoxbYO7NhQ8isokVQB5ezNqp2pdzjND4qqdwXmI0uk8JB3+Bojomeu8SRUYd8vwqJo+7H5mQkQRpKer9xNmvU56O+CN5oVLyjXibZWwgnk6aofnYW4bLukIqHLfwq4Ha9euDcnT4W/sa+Z7kw5reyOj3rR582bezgZW5FjgV76s6bKFQ7ePELVT/Le0LY/ajikI1NiwNvxZhAJWqSK09Qo8k/A4MTls8bAd2ldbnLPpxfUJYfdAGwc1FFLTpk25wYyEZbhhEyZMYJfIdGU0ulFsNm69rlvDhoFPR8z94XrgmE899ZSbEwDnxJg1s/YMh27oY3tYTp0QREAe0OdDsABtL9O1AbC+aM+0adPGzQkFVgrPwdvewagDAKsNcD5Vnnge54dLh85eL7DacFf1mEVYBFwXzhMJ02UE2BfH8B7/rrvuotzc3OBQKYwUCTcyBFFDRDK9lro6WBm0WuB3KGkSxlmhYEfQJoSkw+KuqNZddCV1LNkUEJHCFJDOi4TeNv/sbymp8bU8b+IowWat6U8N837gtlSyem8L6WkauuUR2vS3pu5WoeBRhBNKNLz76MfpzcNytOPD1cKATRBuHN/REOl8aMQjoQIwI2MAkcqBAwfyPAICcBc1GLSLsLlGDzCNdl9YB3cR67FtNFdKBxewjXm8aMePdi8mul1Y0XZHS/TSWkl86G/kD/QqOWgSgvKn0LRdA9gKQRQIBgTF41qmo8afRYdXd6K6WT/wMdE+gvWbebgbDTu3rCB4ifSyouHdB8vh8sxpOFB4ICBbIgKRzoeChPOEK1Dm+dHugLCUi8VJByAALJveP9p9YR2OCStRUXtEF3Lv8aIdP9q9mGCbymx3tFj7jOKOL7fTB7/XjRxwKD2iSotaz5+Tuy9L5R3oNJDqF2zisDcGrXKfUiWBW+g/7ztlkcr6ZEqLM+jIuu6UlJ3Ox4SQINRFsf2o//J/0aSrW9CAdqHju4RQ0JhHyDsS6FhFQKGmCuVfESsWCeTEVdw/w0BIelrUnJ7fcgdlJ7ajYrXIn5Qb7l3lKKsHSosOUMHiVEos3MoigkuHTt+NMR3og0P3UlxiCzonteY/Nfirg3YFwt5oO2GAKgbgLl++nMPYyMfIARFRKNYs0vo9uXTuR4fK2kGRMC2Sy/Q2/1v2PZJajcBARWjBFZw9ixIbX60s0UE6svZiSsrZyiPIdZABFmli/hv0j/TLKdZJoswHmlFCbPjj4yMz72jk6gC/3HSVABrJOhBgC91GEI4d1ixSh6YpymHNV3OqgGurE8SwMmGie3evGEH/yR4cbCPpzlMIwbRQXmsFixOf0ISKC3Ypd64bJRZtYxGiTaRFNP3wWBqxvCsV5Tem/qcURxQRQBQn3CcFR4semoM+Dd2Qxtg72yACpRvT0cB1QMjHCxV9s2UbvINIHerVxZqQ8LuN/764USDggE7XEKKcBr/XkNKIBm95gsbtHkmFqbHBzlMvWmgAIoLVObKpPzmrWrI7F0Ttvys5lcbuGU/3/3o7xdZtRKWxuTSqW2gY1WTXrl3022+/8aBTL3gBCKuid3zbtm2cB1dn2bJlPA/MAqo7JvWAzzFjxgTHl4Ur8BAvhtd8//33vIwvTb/44gueBzg/3CmMDtAdvHAk0HGJa0anJzoekYchPEjhOnIRwsc3PADXAWH9/PPPvIz7wbx5TxgWBJFiFIKuCHBvuBacQzszOA5GGKAzVG8H8Czx/ZG+ZzwjhMUhIFz3VVddVe53LwAGumJfvBOgpzg27h8Jx1mwYAEPhtXgPGi7LVq0KPiccHyIB2nu3Lk0YsSI4DqrwLWzRUlpaflPKCpK6MRFwn4vZTo3T5rurFzQgztrdcL3SkjoUDU7cZF0h6vZobvwv/2cS9/4kTt+fa/tcuImbuFzRGP27Nk8nTx5Mk9N8FkAhvQDVciDw/xVQePh+erFOBs3buQ8oAorT+fNm8dTJRKnoKCA51WBLfd90bhx43iKDsexY8cG55WweP7FF1/kc2C/0aNHcx4+SdDHeeihh3i9PgdAZ29mZqa7FADXgQ5igA5afX3oQMX+4ODBg87evXt5fuDAgTwFyrryFJ3OGnweAXr16hW8lhdeeIGneAY6D59OgDlz5jgbNmzgeYBlL3iOeXl5PK9EzfN4zrj2pUuXcj7uTT9jrFOC4nnz3Snx8xSfeeh7xvWiE7smsGaRgC8mhuZcryxM0LWrhPJ9yWozt10SW0KfHr6eOq99k4bvHEWLnH6U7WtO9Uv/5ITAgf7pLUTskNA/BPD7Qd85V9B126ZQzxX/pvmF7Sg+fj/5YnP414vyhrULbBgB1Kjo78DQFtR2JqjpzjjjDJ5Hx6oeoIof7UBNh/CsGaLVg0TDWR/1zDkMjJpd18b40RCAdk7Xrl2D86jpUXt26dKFj4/90HGJPLTldDj51ltv5Ty4jbCY+PoW1sp7fpxbg3vF17gAHajYD8OJEO7WPPzww+5c2b4YXY3gA369SLf/MPhTXws6b7ENnpfOwxg+JSruSG3fvj3nAQQuvOBTdlgaWA981gFrjef83nvvhXR49+vXj6dYh0/c8SxhPWEpcX0IjACM+dPjIHEP4cbv2cCqkEDvMxrS9a0gIKTKHF5t41MFCkGKmALViMhgYU34czj1TBtDQ9b+i0btGMNtqLTiHpRDbfiHUdLrdKDZ8Vdw/sgto2n4L9Op7/qpNDvjBretpgoLpSgRnUhLbk2lpPjI14KXgJAuXixGJJjujRd0QuoCgsKre+jNQqrnzR8j0cEAvQ5i0z/xBcEArDODBhj5AAGZwoZwcX7deQtQ2JAHNwfXg3GCKGjmNQEsm9eu18N1gzDPPfdcuuWWW1gIAIVfo0UDd6xbt268/O6773Ke+StAAKMg0Hmr0cfxVlBm5aPBt0h4F6hcMFJBj2po165d8PN97Gd+B4X7QKWBwar41aGePXsGf7rL+wxqisqU9Crz5bWtKQa/EFQZMMpBWySICT+KAiHwL68m06f5vemfGbdxG6rzummUumYWpa6eSR3SZlHfteNo8Kr/ofGHHuDtWLz43XAcg6OHpTSpp4+6NovewEfbAAMdUXOhgIcLOJgvzixgutDptgZEgc5LoPdBocNIboBCgEKMAo2EebNA6eMBbe2wL9poELwOVmCEAUY1Q/z4UA3boU0DQeCYX375JW9nAsujP/JDAdPXhzA3RI/9tBgBjq/BPPaBtUOtDsutRYlBsLhu3LsZTEEerg/HRwVhHg/AqnmB9dL5aJOiwsAI7muvvTY4GBXn0O0xWB4ID0OVfvrpJ94P++hAhvnecA3aUtnGWvjbi/KOKe71X8pEAtzCzfrVY+8qCpd7MYcaBV1HdTztTkJEQFm5Ls0cWjYw9BOCcKA2M8PUeEGmZdCFXRd4PDI9j5eGgoUpGrmoDQH2RyHSBQtuCgoCttUFUGOez5xHQdRj3PDTXbgO81MEuECINCKooffBNzj48RCMdtbXZoIChpHXEAuuQ98Hgg2oROCS6WvApwlaVPpeMIX7BMHC8uFZ4Aci8akGRoUjT4NR2bC655xzDi+bzwNgGWKBJTSB8PC8YPlwfnM/XdHAuiEfQsG9AlwL7g/balfc292AygnoMYK2qDEhAdV8pbtm7qAZ292XCUuj+5EqGuRaVXBcJIyeUGJ7o3sSDesceTiQYAeIGxE2WIXaApYXFYDXpTyW1KiQAP7v0fhlGfT35cbIB/x+A/84pFvwqwKGGrEQXXEGj4OaO1DTr7+5CZ2Dfi1BqCVqXEiaPbl+evj7nfT5HuWCoO8IgQX+QZRQN6dCeMyeEg36q/BFLo4DlLWb0r0x3dWxASXGVfGYglBNak1Imt1HiumU/6QrQai2k18JKrGKIwm0a6jbSqoBft2ZKTS572nUvG7NhDYFoSJqXUiag/nFNGN9Dv3fjmRa/udBI4BQATpI4cumWTe2pMtaJFGdKMN+BKE2OGZC0uDshSWltP1QAc3fUUDf/HaI4nwxNHNfTLD9c0OzJHLU3/Xoo2pbjxrU8Yl4hOOKYy6kcOCCcFXB3hU1E5wXhOOQ41JIgvBXQ/wjQbCACEkQLCBCEgQLiJAEwQIiJEGwgAhJECwgQhIEC4iQBMECIiRBsIAISRAsIEISBAuIkATBAiIkQbCACEkQLCBCEgQLiJAEwQIiJEGwgAhJECwgQhIEC4iQBMECIiRBsIAISRAsIEISBAuIkATBAiIkQbCACEkQLCBCEgQLiJAEwQIiJEGwgAhJECwgQhIEC4iQBMECIiRBsIAISRAsIEISBAuIkATBAiIkQbCACEkQLCBCEgQLiJAEodoQ/T/LoNaahSwtTgAAAABJRU5ErkJggg==" alt="" width="150" /></td>
            <td align="right">
                <h3>PT BMC Logistics</h3>
                <pre>
                Jl. Prapat Kurung Utara 58 Surabaya 60165 Indonesia
                Phone 
                Customer Service +6231 3282271
                Warehouse +6231 3282271
                Email 
                info@bmclogistic.co.id
            </pre>
            </td>
        </tr>

    </table>
    <table width="100%">
        <tr>
            <td align="center">
                <h1>Berita Acara <?= $order['order_type'] ?> Inventaris PT BMC Logistics</h1>
            </td>
        </tr>

    </table>
    <table width="100%">
        <tr>
            <td>Nama </td>
            <td>: </td>
            <td><?= $order['nama'] ?></td>

        </tr>
        <tr>
            <td>Nrp </td>
            <td>: </td>
            <td><?= $order['nrp'] ?></td>

        </tr>

    </table>

    <br><br>
    <table width="100%">
        <tr>
            <td>
                Melakukan <strong><?= $order['order_type'] ?></strong> Inventaris PT. BMC Logistics pada hari <?= date_format(new DateTime($order['created_at']), 'l,d F Y - H:i:s') ?> dengan rincian inventaris sebagai berikut :
            </td>

        </tr>

    </table>
    <br><br>
    <table width="100%">
        <tr>
            <td><strong>To:</strong> <?= $order['unitkerja'] ?></td>
        </tr>
    </table>

    <br />

    <table width="100%">
        <thead style="background-color: lightgray;">
            <tr>
                <th>#</th>
                <th>Kode Product</th>
                <th>Nama Product</th>
                <th>Brands</th>
                <th>Jumlah</th>
                <th>Peruntukan</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dataorder as $key =>  $unit) : ?>
                <tr>
                    <td><?= $key ?></td>
                    <td><?= '' . $unit['kode'] . '' ?></td>
                    <td><?= $unit['nama_unit'] ?></td>
                    <td><?= $unit['brand'] ?></td>
                    <td>1</td>
                    <td><?= $unit['nama'] ?></td>
                </tr>
            <?php endforeach ?>

        </tbody>


    </table>

    <br><br>
    <table width="100%">
        <tr>
            <td><strong>Dengan Keterangan: </strong> <?= $order['description'] ?></td>
        </tr>
    </table>

    <br><br>
    <table width="100%">
        <tr>
            <td><?= $order['feedbackdescription'] == null ? null : '<strong>Ditolak dengan Alasan: </strong>' . $order['feedbackdescription'] . '' ?>
            </td>
        </tr>
    </table>

    <br><br><br><br><br><br>
    <table width="100%">
        <tr>
            <td align="center">
                <div class="tanggalapprove" id="tanggalapprove"><?= $order['updated_at'] == null ? null : date_format(new DateTime($order['updated_at']), 'd F Y ');  ?></div>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td align="center"><?= date_format(new DateTime($order['created_at']), 'd F Y ') ?></td>
        </tr>

        <tr>
            <td align=" center"><strong><?= $approval['name'] == null ? null : 'Mengetahui'; ?></strong></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td align="center"><strong>Pemohon</strong></td>
        </tr>
        <tr>
            <td style="min-width: 75px;" align="center"><strong><?= $approval['name'] ?></strong></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td align="center"><strong><?= $order['content'] ?></strong></td>
        </tr>
        <tr>
            <td align="center">
                <?= $barcode1 == null ? null : '<img src="' . $barcode1 . '" alt="" width="75">'; ?>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td align=" center">
                <img src="<?= $barcode ?>" alt="" width="75">
            </td>
        </tr>
        <tr>
            <td align=" center"><strong><?= $approval['nama'] ?></strong></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td align="center"><strong><?= $order['nama'] ?></strong></td>
        </tr>


    </table>

</body>

</html>