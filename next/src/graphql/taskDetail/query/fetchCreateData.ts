import { gql } from '@apollo/client';
import { TaskStatus } from 'models/task_status';

export const FETCH_CREATE_DETAIL_QUERY = gql`
  query FetchCreateDetailData {
    task_statuses {
      id
      status
    }
  }
`;

export interface TaskCreateDetailData {
  task_statuses: TaskStatus[];
}
