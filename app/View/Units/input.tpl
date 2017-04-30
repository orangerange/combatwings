<h1>ユニット登録</h1>
{$this->Form->create('Unit')}
<table>
    <thead>
    </thead>
    <tbody>
        <tr>
            <th>
                機種名
            </th>
            <td>
                {$this->form->input('name')}
            </td>
        </tr>
        {section name=i start=1 loop=4}
            {assign var='index' value=$smarty.section.i.index}
            <th>戦闘速度{$configure.Master.Period.$index}</th>
            <td>
                {$this->Form->password('password')}
            </td>
        {/section}
    </tbody>
</table>
{$this->form->end}